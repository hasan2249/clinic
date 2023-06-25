<?php

namespace App\Models\Traits\Attributes;

trait PatientAttributes
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">
                    ' . $this->getAppointments('edit-page', 'admin.appointments.patient.view') . '  
                    ' . $this->getSessions('edit-page', 'admin.sessions.patient.view') . ' 
                    ' . $this->getEditButtonAttribute('edit-page', 'admin.Patients.edit') . '                    
                    ' . $this->getDeleteButtonAttribute('delete-page', 'admin.Patients.destroy') . '
                </div>';
    }

    /**
     * @return string
     */
    public function getViewButtonAttribute()
    {
        return '<a target="_blank" href="' . route('frontend.Patients.show', $this->page_slug) . '" class="btn btn-flat btn-default">
                    <i data-toggle="tooltip" data-placement="top" title="View Page" class="fa fa-eye"></i>
                </a>';
    }

    /**
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        if ($this->isActive()) {
            return "<label class='label label-success'>" . trans('labels.general.active') . '</label>';
        }

        return "<label class='label label-danger'>" . trans('labels.general.inactive') . '</label>';
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->status == 1;
    }

    /**
     * Get Display Status Attribute.
     *
     * @var string
     */
    public function getDisplayStatusAttribute(): string
    {
        return $this->isActive() ? 'Active' : 'InActive';
    }
}
