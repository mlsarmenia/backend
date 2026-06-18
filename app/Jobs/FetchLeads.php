<?php

namespace App\Jobs;

use App\Enum\B24\Contact;
use App\Enum\B24\ContactStatus as B24ContactStatus;
use App\Enum\B24\Lead;
use App\Enum\B24\Lead\Area;
use App\Enum\B24\Lead\Room;
use App\Enum\ContactStatus;
use App\Enum\ContactType;
use App\Enum\ContractType;
use App\Models\B24InfoSource;
use App\Models\Client;
use App\Models\Contact as ContactModel;
use App\Models\Project;
use Bitrix24\SDK\Services\ServiceBuilderFactory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class FetchLeads implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected ?array $ids, protected ?int $offset = null)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $apiBase = config('bitrix24.api_base');
        $b24Service = ServiceBuilderFactory::createServiceBuilderFromWebhook($apiBase);
        $order = [];
        $filter = [];
        $select = array_column(Lead::cases(), 'value');
        $offset = 0;

        if ($this->ids) {
            $filter['@ID'] = $this->ids;
        }

        if ($this->offset) {
            $offset = $this->offset;
        }

        $leads = $b24Service->getCRMScope()->lead()->list(
            $order,
            $filter,
            $select,
            $offset
        )->getCoreResponse()
            ->getResponseData()
            ->getResult();
        $data = [];
        $contactIds = array_column($leads, 'CONTACT_ID');
        $filter = ['@ID' => $contactIds];
        $select = array_column(Contact::cases(), 'value');
        $contacts = $b24Service->getCRMScope()->contact()->list(
            $order,
            $filter,
            $select,
            $offset
        )->getCoreResponse()
            ->getResponseData()
            ->getResult();
        $contacts = array_column($contacts, null, 'ID');

        foreach ($leads as $lead) {
            $person = $lead;
            $contactId = $lead['CONTACT_ID'];
            $contact = null;

            if ($contactId && isset($contacts[$contactId])) {
                $person = $contacts[$contactId];
                $contact = $contacts[$contactId];
            }

            $data[] = [
                'email' => $person['EMAIL'][0]['VALUE'] ?? null,
                'contact_type_id' => ContactType::BUYER->value,
                'phone_mobile_1' => $person['PHONE'][0]['VALUE'] ?? null,
                'name_arm' => $person['NAME'],
                'last_name_arm' => $person['LAST_NAME'],
                'is_buyer' => true,
                'b24_lead_id' => $lead['ID'],
                'b24_contact_id' => $contact['ID'] ?? null,
            ];
        }

        ContactModel::query()->upsert($data, 'b24_lead_id');
        $leadIds = array_column($leads, 'ID');
        $mapping = ContactModel::query()->whereIn('b24_lead_id', $leadIds)->pluck('id', 'b24_lead_id');
        $clientData = [];
        $infoSources = B24InfoSource::query()->pluck('id', 'slug');

        foreach ($leads as $lead) {
            $localContactId = $mapping[$lead['ID']] ?? null;
            $projectId = $lead[Lead::PROJECT->value];
            $project = Project::query()->whereHas('b24LeadProject', function ($query) use ($projectId) {
                $query->where('id', $projectId);
            })->first();
            $areaOption = $lead[Lead::AREA->value][0] ?? null;
            $area = $areaOption ? Area::tryFrom($areaOption) : null;
            $roomsOption = $lead[Lead::ROOMS->value][0] ?? null;
            $rooms = $roomsOption ? Room::tryFrom($roomsOption) : null;

            $clientData[] = [
                'contact_id' => $localContactId,
                'estate_contract_type_id' => ContractType::SALE->value,
                'contact_status_id' => $lead['STATUS_ID'] === B24ContactStatus::FAILED->value
                    ? ContactStatus::LOST->value
                    : ContactStatus::CURRENT->value,
                'info_source_id' => $infoSources[$lead[Lead::SOURCE_ID->value]] ?? null,
                'project_id' => $project?->id,
                'area_from' => $area->fromArea(),
                'area_to' => $area->toArea(),
                'room_count_from' => $rooms->fromNumber(),
                'room_count_to' => $rooms->toNumber(),
            ];
        }

        Client::query()->upsert($clientData, 'contact_id');
    }
}
