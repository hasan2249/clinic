<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <a class="dropdown-item" href="{{ route('admin.appointments.index') }}">سجل المواعيد</a>
        @if(isset($patient_id))
        <a class="dropdown-item" href="{{ route('admin.patient.create.appointment', ['patient_id' => $patient_id]) }}">موعد جديد</a>
        @endif
        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>