@extends('cms.layouts.master')

@section('content')

<div class="content-wrapper"> 
  <!-- Content Header (Page header) -->
  <div class="content-header sty-one">
    <h1>Edit Tool Tip</h1>
    <ol class="breadcrumb">
      <li><a href="{!! route('cms::dashboard') !!}">Dashboard</a></li>
      <li><a href="{!! route('cms::tooltips.index') !!}"><i class="fa fa-angle-right"></i> Tool Tip</a></li>
      <li><i class="fa fa-angle-right"></i> Edit Tool Tip</li>
    </ol>
  </div>

  <div class="content"> 
    {!! Form::model($tooltip,['route' => ['cms::tooltips.update', $tooltip->id], 'method' => 'patch','files'=>true, 'id' => 'post_form']) !!}
    <div class="row">
      <div class="col-md-9 col-sm-8 col-xs-12">
        <div class="card">
          <div class="card-body">
                       
      
            <div class="form-group">
              {!! Form::label('tip',ucwords(str_replace("_", " ", $tip))) !!}
              {!! Form::hidden('title', $tip) !!}
      
              <textarea name="tip" class="textarea from-control" id="content">
                {!! $tooltip->$tip !!}
              </textarea>
            </div>
          </div>
      
          <div class="card-footer">
            {!! Form::submit('Submit',['class' => 'btn btn-primary', 'id' => 'submit_btn']) !!}
      
            <a href="{!! route('cms::tooltips.index') !!}" title="Cancel" class="btn btn-danger cancel-btn">Cancel</a>
          </div>
      
        </div>
      </div>
      <!--</add news>-->
      
      <!--<right side bar>-->
      <div class="col-md-3 col-sm-4 col-xs-12 right-side-bar">
      
      </div>
      <!--</right side bar>-->
    </div>
    {!! Form::close() !!}
    <!-- /.row -->
  </div>

</div>

@endsection

@section('custom-scripts')


<script src="{{asset('cms/vendors/ckeditor5/build/ckeditor.js')}}"></script>

<script>
ClassicEditor.create(document.querySelector('#content'), {

toolbar: {
  items: [
    'heading',
    '|',
    'bold',
    'italic',
    'link',
    'bulletedList',
    'numberedList',
    '|',
    'outdent',
    'indent',
    '|',
    'ImageResize',
    'blockQuote',
    'insertTable',
    'mediaEmbed',
    'undo',
    'redo',
    '-',
    'alignment',
    'findAndReplace',
    'fontColor',
    'fontSize',
    'htmlEmbed',
    'sourceEditing'
  ],
  shouldNotGroupWhenFull: true
},
language: 'en',
image: {
  toolbar: [
    'toggleImageCaption',
    'imageTextAlternative',
    '|',
    'imageStyle:inline',
    'imageStyle:block',
    '|',
    'imageStyle:alignLeft',
    'imageStyle:alignCenter',
    'imageStyle:alignRight',
    '|',
    'resizeImage'
  ],
  styles: [
    'full',
    'alignLeft',
    'alignRight'
  ]
},
table: {
  contentToolbar: [
    'tableColumn',
    'tableRow',
    'mergeTableCells',
    'tableCellProperties',
    'tableProperties'
  ]
}
})
.then(editor => {
window.editor = editor;
})
.catch(error => {
console.error('Oops, something went wrong!');
console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
console.warn('Build id: 1wenxz12z32c-nlfnsv4zz7h3');
console.error(error);
});


</script>
@endsection

@section('custom-styles')
<link href="{{asset('cms/vendors/ckeditor5/build/style.css')}}" rel="stylesheet" />

<style>
#addMedia{
  margin:20px 0px;
}
#imageLibrary{
  background: #FFFFFF90;
  padding: 20px 60px 20px 60px;
}
#imageLibrary>.content{
  padding: 10px 20px;
  border: #CCC solid 1px;
  background: #FFFFFF;
}
.select{
  margin: 10px 0px 10px 0px;
}
.select>a{
  width:100%;
}
#featured_image>img{
  width:100%;
  margin-bottom: 30px;
}
.modal-header{
  background: #FFF;
  border: solid 1px #CCC;
}
</style>
@endsection