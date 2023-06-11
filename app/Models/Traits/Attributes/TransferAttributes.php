<?php

namespace App\Models\Traits\Attributes;

trait TransferAttributes
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">
					'.$this->getReciveButtonAttribute('edit-page', 'admin.transfers.edit').' 
                    '.$this->getEditButtonAttribute('edit-page', 'admin.transfers.edit').'                    
                    '.$this->getDeleteButtonAttribute('delete-page', 'admin.transfers.destroy').'
                </div>';
    }

	/**
     * @return string
     */
    public function getReciveButtonAttribute()
    {
        return "<button id='choose_user' name='btn-choose' data-toggle='modal' data-target='#confirm-popup' onclick='reciveTransfer(this,\"".$this->id."\",\"".$this->client->name."\",\"".$this->amount."\",\"".$this->company->name."\",\"".$this->note."\",\"".$this->client->mother_name."\",\"".$this->client->birthday."\")' type='button' class='btn btn-success btn-sm'>تسليم الحوالة</button>
    ";
    }
	
	/**
     * @return string
     */
    public function getViewButtonAttribute()
    {
        return '<a  href="'.route('admin.transfers.show', $this).'" class="btn btn-warning   btn-sm">
                    تفاصيل الحوالة
                </a>';
    }
	
	public function getRollbackButtonAttribute()
    {
        return '<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#Modal'.$this->id.'">
				  تراجع عن التسليم
				</button>
				<div class="modal fade" id="Modal'.$this->id.'" tabindex="-1" role="dialog" aria-labelledby="ModalLabel'.$this->id.'" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="ModalLabel'.$this->id.'">تأكيد التراجع</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						هل تريد التراجع عن تسليم الحوالة التي قيمتها <b>'.$this->amount.' </b> بالفعل؟ <br/>
						علما انه قد تم تسليمها بتاريخ <b>'.$this->delivered_at.'</b><br/>
						في حال المتابعة سيتم تصنيف هذه الحوالة على انها لم يتم تسليمها بعد
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
						<a  href="'.route('admin.transfers.rollback.get', $this).'" class="btn btn-primary">متابعة التراجع عن التسليم</a>
					  </div>
					</div>
				  </div>
				</div>';
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
    