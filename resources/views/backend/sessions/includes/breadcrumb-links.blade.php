<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <a class="dropdown-item" href="{{ route('admin.sessions.index') }}">سجل الجلسات</a>
        @if(isset($patient_id))
        <a class="dropdown-item" href="{{ route('admin.patient.create.session', ['patient_id' => $patient_id]) }}">جلسة جديدة</a>
        @endif
        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>