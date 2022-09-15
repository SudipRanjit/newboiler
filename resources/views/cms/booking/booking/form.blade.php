<div class="col-md-9 col-sm-8 col-xs-12">
  <div class="card">
    <div class="card-body">
      
      <input type='hidden' name='order_id' value='{!! $booking->order_id !!}' />

      <div class="form-group">
        {!! Form::label('booking_id','ID') !!}
        {!! Form::text('booking_id',null,['class' => 'form-control', 'id' => 'booking-id','readonly'=>'readonly']) !!}
      </div>
  
      <div class="form-group">
        {!! Form::label('order_transaction_id','Order ID') !!}
        <input type="text" class='form-control' id='order_transaction_id' value='{!! $booking->order->transaction_id !!}' readonly="readonly" >
      </div>
      
      <div class="form-group">
        {!! Form::label('amount','Amount') !!}
        {!! Form::number('amount',null,['class'=>'form-control', 'placeholder'=>'Enter Amount', 'id'=>'amount', 'step' => '.01']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('discount','Discount') !!}
        {!! Form::number('discount',null,['class'=>'form-control', 'placeholder'=>'Enter Discount (if any)', 'id'=>'discount', 'step' => '.01']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('appointment_date',"Appointment Date") !!}
        {!! Form::date('appointment_date',null,['class' => 'form-control', 'id' => 'appointment-date']) !!}
      </div>

      <div class="form-group">
        {!! Form::label('status',"Booking Status") !!}
        {!! Form::select('status',['0'=>'On process','1'=>'Complete','2'=>'Cancel','3'=>'Finance Awaiting','4'=>'Finance Approved','5'=>'Finance Rejected'],null,['class' => 'form-control', 'id' => 'status']) !!}
      </div>

      <div class="form-group">
        <label>Payout Status:</label>
        @if($booking->order->status=='0')
              <span class="label label-danger">InComplete</span>
        @elseif($booking->order->status=='1')
              <span class="label label-success">Complete</span>
        @endif
      </div>

      <div class="form-group">
        {!! Form::label('note',"Note") !!}
        {!! Form::textarea('note',null,['class' => 'form-control', 'id' => 'note']) !!}
      </div>
      
    </div>
 
    </div>
    <!-- /.box-body -->

    <div class="card-footer">
      {!! Form::submit('Submit',['class' => 'btn btn-primary', 'id' => 'submit_btn']) !!}

      <a href="{!! route('cms::bookings.index') !!}" title="Cancel" class="btn btn-danger cancel-btn">Cancel</a>
    </div>

  </div>
</div>
<!--</add news>-->



  
  