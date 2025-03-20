@extends('admin.layouts.master')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Import Products</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.export.product') }}" class="btn btn-success">
                            Download Xlsx
                        </a>

                    </div>
                </div>


                <div class="card-body">
                    <form action="{{ route('admin.import.file.product') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="row ">
                                <div class="col-md">
                                    <label class="form-label text-capitalize">Xlsx Import</label>

                                    <input type="file" name="import_file" class="form-control" />
                                </div>
                                <div class="col-md">

                                </div>

                            </div>

                        </div>

                        <div class="mb-3 mt-4">
                            <button class="btn btn-primary" type="submit">
                                <i class="ti ti-device-floppy"></i>
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
