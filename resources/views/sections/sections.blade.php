@extends('layouts.master')
@section('title')
    الاقسام
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الاعدادات </h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الاقسام</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session()->has('Add'))
        <x-alert type="success" :message="session()->get('Add')" />
    @endif

    @if (session()->has('Edit'))
        <x-alert type="success" :message="session()->get('Edit')" />
    @endif

    @if (session()->has('delete'))
        <x-alert type="danger" :message="session()->get('delete')" />
    @endif
    <!-- row -->
    <div class="row">

        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale"
                           data-toggle="modal" href="#modaldemo8">اضافة قسم</a>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">اسم القسم</th>
                                <th class="border-bottom-0">اسم الفرع</th>
                                <th class="border-bottom-0">الحاله</th>
                                <th class="border-bottom-0">الصوره</th>
                                <th class="border-bottom-0">الوصف</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach ($sections as $section)
                                    <?php $i++;?>
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $section->section_name }}</td>
                                    <td>{{ $section->branch->branch_name}}</td>
                                    <td>
                                        @if ($section->status == 0)
                                            <span class="text-success">{{ \App\Enums\SectionStatus::getStatusText($section->status) }}</span>
                                        @elseif ($section->status == 1)
                                            <span class="text-warning">{{ \App\Enums\SectionStatus::getStatusText($section->status) }}</span>
                                        @else
                                            <span class="text-muted">غير معروف</span>
                                        @endif
                                    </td>


                                    <td><img   class="col-4 rounded-circle img-fluid  " style="width: 150px; height: 150px;" src="{{$section->getFirstMediaUrl('media')}}"></td>
                                    <td>{{ $section->description }}</td>
                                    <td>

                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                           data-id="{{ $section->id }}"
                                           data-section_name="{{ $section->section_name }}"
                                           data-branch_name="{{ $section->branch['branch_name'] }}"
                                           data-description="{{ $section->description }}"
                                           data-status="{{ $section->status }}"
                                           data-pic="{{ $section->pic }}"
                                           data-toggle="modal"
                                           href="#exampleModal2" title="تعديل"><i class="las la-pen"></i></a>

                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                               data-id="{{ $section->id }}"
                                               data-section_name="{{ $section->section_name }}"
                                               data-toggle="modal" href="#modaldemo9" title="حذف"><i
                                                    class="las la-trash"></i></a>


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="modal" id="modaldemo8">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal"
                                                                          type="button"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('sections.store')}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="section_name">اسم القسم</label>

                                    <input type="text" class="form-control" id="section_name" name="section_name">
                                    @error('section_name')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">الفرع</label>
                                <select name="branch_id" id="branch_id" class="form-control" required>
                                    <option value="" selected disabled> --حدد الفرع--</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                    @endforeach
                                </select>
                                </div>


                                <div class="form-group">
                                    <label for="status">الحاله</label>
                                    <select class="form-control" id="status" name="status">
                                        <option selected="true" disabled="disabled">-- حدد حالة الدفع --</option>
                                        <option value="{{ \App\Enums\SectionStatus::Active }}">مفعل</option>
                                        <option value="{{ \App\Enums\SectionStatus::UnActive }}">غير مفعل</option>
                                    </select>
                                    @error('pic')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="pic">الصوره</label>
                                    <input type="file" name="pic" id="pic" class="dropify form-control" accept=".pdf,.jpg,.png,image/jpeg,image/png" data-height="70" >
                                    @error('pic')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>



                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">ملاحظات</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">تاكيد</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
        </div>


        <!-- edit -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="sections/update" method="post" autocomplete="off" enctype="multipart/form-data">
                            {{ method_field('patch') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="hidden" name="id" id="edit_id" >
                                <label for="recipient-name" class="col-form-label">اسم القسم:</label>
                                <input class="form-control" name="section_name" id="section_name" type="text">
                            </div>

                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                            <select name="branch_name" id="branch_name" class="custom-select my-1 mr-sm-2" required>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                @endforeach
                            </select>

                            <div class="form-group">
                                <label for="edit_status">الحالة:</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="{{ \App\Enums\SectionStatus::Active }}">مفعل</option>
                                    <option value="{{ \App\Enums\SectionStatus::UnActive }}">غير مفعل</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pic">الصورة</label>
                                <input type="file" name="pic" id="pic" class="dropify form-control" accept=".pdf,.jpg,.png,image/jpeg,image/png" data-height="70">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">ملاحظات:</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- delete -->
            <div class="modal" id="modaldemo9">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h6 class="modal-title">حذف القسم</h6>
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="/sections/destroy" method="post">
                            {{ method_field('delete') }}
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                <input type="hidden" name="id" id="delete_id">
                                <input class="form-control" name="section_name" id="delete_section_name" type="text" readonly>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                <button type="submit" class="btn btn-danger">تاكيد</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- row closed -->
        </div>
        <!-- Container closed -->
        </div>
        <!-- main-content closed -->
    @endsection
    @section('js')
        <!-- Internal Data tables -->
        <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
        <!--Internal  Datatable js -->
        <script src="{{URL::asset('assets/js/table-data.js')}}"></script>


        <script>

                $('#exampleModal2').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var section_name = button.data('section_name')
                var branch_name =button.data('branch_name')
                var description = button.data('description')
                var status = button.data('status')
                var pic = button.data('pic')
                var modal = $(this)
                modal.find('.modal-body #edit_id').val(id);
                modal.find('.modal-body #section_name').val(section_name);
                modal.find('.modal-body #branch_name').val(branch_name);
                modal.find('.modal-body #description').val(description);
                modal.find('.modal-body #status').val(status);
                    // modal.find('.modal-body #pic').val(pic);
            })




            $('#modaldemo9').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var section_name = button.data('section_name');

                var modal = $(this);
                modal.find('.modal-body #delete_id').val(id);
                modal.find('.modal-body #delete_section_name').val(section_name);
            });
        </script>
    @endsection
