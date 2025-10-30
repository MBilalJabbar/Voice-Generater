@extends('admin.layouts.app')

@section('title')
    Payment Proof
@endsection

@section('body')
    <div class="container-fluid">
        <!-- PAGE HEADER AND ADD BUTTON -->
        <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
            <nav>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Payment Proof</li>
                </ol>
            </nav>
        </div>

        <!-- PAYMENT PROOF TABLE -->
        <div class="col-xl-12">
            <div class="card custom-card overflow-hidden">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 style="font-size: 20px;font-weight:800">Payment Proofs</h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-hover text-nowrap" style="background: #003E78;">
                            <thead>
                                <tr>
                                    <th style="background: #003E78; color:white">Sr #</th>
                                    <th style="background: #003E78; color:white">Image</th>
                                    <th style="background: #003E78; color:white">Name</th>
                                    <th style="background: #003E78; color:white">Email</th>
                                    <th style="background: #003E78; color:white">Phone Number</th>
                                    <th style="background: #003E78; color:white">Plan</th>
                                    <th style="background: #003E78; color:white">Plan Day Remaining</th>
                                    <th style="background: #003E78; color:white">Payment Proof</th>
                                    <th style="background: #003E78; color:white">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><img src="{{ asset('assets/images/profile.png') }}" width="40"
                                            class="rounded-circle border"></td>
                                    <td>Ali Khan</td>
                                    <td>ali@example.com</td>
                                    <td>0300-1234567</td>
                                    <td>Premium</td>
                                    <td>25 days</td>
                                    <td><img src="assets/images/payment-proof.png" width="50" class="border rounded">
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="#" class="btn btn-light btn-sm rounded-circle border"
                                                title="Edit"><i class="fa fa-pen-to-square text-warning"></i></a>
                                            <a href="#" class="btn btn-light btn-sm rounded-circle border"
                                                title="View"><i class="fa fa-eye text-primary"></i></a>
                                            <button class="btn btn-light btn-sm rounded-circle border" title="Delete"><i
                                                    class="fa fa-trash text-danger"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><img src="{{ asset('assets/images/profile.png') }}" width="40"
                                            class="rounded-circle border"></td>
                                    <td>Sara Ahmed</td>
                                    <td>sara@example.com</td>
                                    <td>0312-7654321</td>
                                    <td>Free</td>
                                    <td>18 days</td>
                                    <td><img src="assets/images/payment-proof.png" width="50" class="border rounded">
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="#" class="btn btn-light btn-sm rounded-circle border"
                                                title="Edit"><i class="fa fa-pen-to-square text-warning"></i></a>
                                            <a href="#" class="btn btn-light btn-sm rounded-circle border"
                                                title="View"><i class="fa fa-eye text-primary"></i></a>
                                            <button class="btn btn-light btn-sm rounded-circle border" title="Delete"><i
                                                    class="fa fa-trash text-danger"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><img src="{{ asset('assets/images/profile.png') }}" width="40"
                                            class="rounded-circle border"></td>
                                    <td>Bilal Iqbal</td>
                                    <td>bilal@example.com</td>
                                    <td>0333-4445556</td>
                                    <td>Standard</td>
                                    <td>12 days</td>
                                    <td><img src="assets/images/payment-proof.png" width="50" class="border rounded">
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="#" class="btn btn-light btn-sm rounded-circle border"
                                                title="Edit"><i class="fa fa-pen-to-square text-warning"></i></a>
                                            <a href="#" class="btn btn-light btn-sm rounded-circle border"
                                                title="View"><i class="fa fa-eye text-primary"></i></a>
                                            <button class="btn btn-light btn-sm rounded-circle border" title="Delete"><i
                                                    class="fa fa-trash text-danger"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><img src="{{ asset('assets/images/profile.png') }}" width="40"
                                            class="rounded-circle border"></td>
                                    <td>Hira Fatima</td>
                                    <td>hira@example.com</td>
                                    <td>0345-2233445</td>
                                    <td>Premium</td>
                                    <td>20 days</td>
                                    <td><img src="assets/images/payment-proof.png" width="50" class="border rounded">
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="#" class="btn btn-light btn-sm rounded-circle border"
                                                title="Edit"><i class="fa fa-pen-to-square text-warning"></i></a>
                                            <a href="#" class="btn btn-light btn-sm rounded-circle border"
                                                title="View"><i class="fa fa-eye text-primary"></i></a>
                                            <button class="btn btn-light btn-sm rounded-circle border" title="Delete"><i
                                                    class="fa fa-trash text-danger"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><img src="{{ asset('assets/images/profile.png') }}" width="40"
                                            class="rounded-circle border"></td>
                                    <td>Usman Riaz</td>
                                    <td>usman@example.com</td>
                                    <td>0301-9876543</td>
                                    <td>Basic</td>
                                    <td>14 days</td>
                                    <td><img src="assets/images/payment-proof.png" width="50" class="border rounded">
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="#" class="btn btn-light btn-sm rounded-circle border"
                                                title="Edit"><i class="fa fa-pen-to-square text-warning"></i></a>
                                            <a href="#" class="btn btn-light btn-sm rounded-circle border"
                                                title="View"><i class="fa fa-eye text-primary"></i></a>
                                            <button class="btn btn-light btn-sm rounded-circle border" title="Delete"><i
                                                    class="fa fa-trash text-danger"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Continue same pattern for other rows -->
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
