<?php

namespace App\Models\Traits\Attributes;

trait CompanyAttributes
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">
					'.$this->getViewButtonAttribute($this).'
                    '.$this->getEditButtonAttribute('edit-page', 'admin.companys.edit').' 
					'.$this->getChargeButtonAttribute().'
					'.$this->getLogChargeAttribute().' 					
                </div>';
				// '.$this->getDeleteButtonAttribute('delete-page', 'admin.companys.destroy').'
    }

    /**
     * @return string
     */
    public function getChargeButtonAttribute()
    {
        return '<a href="'.route('admin.companys.charge.show', $this).'" class="btn btn-flat btn-success">
                    شحن الرصيد
                </a>';
    }
	
	/**
     * @return string
     */
    public function getLogChargeAttribute()
    {
        return '<a href="'.route('admin.companys.charge.log', $this->id).'" class="btn btn-flat btn-dark">
                    سجل الشحن
                </a>';
    }
	
    /**
     * @return string
     */
    public function getViewButtonAttribute()
    {
        return '<a target="_blank" href="'.route('admin.companys.show', $this).'"  class="btn btn-flat btn-danger">
                    عرض
                </a>';
    }

	
    /**
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        if ($this->isActive()) {
            return "<label class='label label-success'>".trans('labels.general.active').'</label>';
        }

        return "<label class='label label-danger'>".trans('labels.general.inactive').'</label>';
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
    