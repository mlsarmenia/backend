{{-- This file is used to store topbar (right) items --}}


{{-- <li class="nav-item d-md-down-none"><a class="nav-link" href="#"><i class="la la-bell"></i><span class="badge badge-pill badge-danger">5</span></a></li>
<li class="nav-item d-md-down-none"><a class="nav-link" href="#"><i class="la la-list"></i></a></li>
<li class="nav-item d-md-down-none"><a class="nav-link" href="#"><i class="la la-map"></i></a></li> --}}

<form id="currency-form" method="post" action="{{ route('setCurrency') }}">
    @csrf
    <select name="currency" id="currency" onchange="submitForm()">
        <option value="AMD" {{  session('currency') === 'AMD' ? 'selected' : '' }}>AMD</option>
        <option value="USD" {{ session('currency') === 'USD' ? 'selected' : '' }}>USD</option>
        <option value="RUB" {{ session('currency') === 'RUB' ? 'selected' : '' }}>RUB</option>
    </select>
    <!-- Hidden submit button -->
    <button type="submit" style="display: none;" id="submit-button">Set Currency</button>
</form>
<script>
    function submitForm() {
        document.getElementById('submit-button').click();
    }
</script>
