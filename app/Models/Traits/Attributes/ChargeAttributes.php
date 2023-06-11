<?php

namespace App\Models\Traits\Attributes;

trait ChargeAttributes
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn"> 
                    '.$this->getEditChargeAttribute().'                    
                    '.$this->getDeleteButtonAttribute('delete-page', 'admin.companys.charges.destroy').'
                </div>';
    }
	
	public function getEditChargeAttribute()
    {
        return '<button type="button" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#Modal'.$this->id.'">
				  تعديل
				</button>
				<div class="modal fade" id="Modal'.$this->id.'" tabindex="-1" role="dialog" aria-labelledby="ModalLabel'.$this->id.'" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <form action="'.route('admin.companys.charges.update', $this).'" method="POST">
					  <input type="hidden" name="_token" value="'.csrf_token().'" />
					  <input type="text" name="_method" value="PATCH" hidden />
					  <div class="modal-header">
						<h5 class="modal-title" id="ModalLabel'.$this->id.'">تعديل قيمة الشحن</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
					  <div class="form-group row">
						<label class="col-md-4 from-control-label required">قيمة الشحن الحالية</label>
						<div class="col-md-8">
							<b>'.$this->amount.' </b>
						</div>
						</div>
						<div class="form-group row">
						<label class="col-md-4 from-control-label required"> القيمة الجديدة</label>
						<div class="col-md-8">
							<input name="amount" type="number" class="form-control" min="0" required />
						</div>
						<!--col-->
						</div>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
						<input type="submit" value="حفظ التعديل" class="btn btn-primary"></input>
					  </div>
					  </form>
					</div>
				  </div>
				</div>';
    }
	
}