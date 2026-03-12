@extends('frontend.layout.app')

@section('title', 'My Profile - Rana Marble | Divine Marble')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('./css/account.css') }}">
</head>


    <!-- CONTENT -->
    <section class="wishlist-section">
        <div class="container">
            <div class="profile-layout full-width-layout">
                <!-- Sidebar -->


                <!-- Main Content -->
                <div class="profile-content">
                    <!-- PERSONAL DETAILS TAB -->
                    <div id="tab-personal" class="tab-pane active">
                        <h2 class="tab-title">Personal Details</h2>
                        <form class="profile-form" onsubmit="event.preventDefault(); alert('Details Updated!');">
                            <div class="form-group row">
                                <div class="col">
                                    <label>First Name</label>
                                    <input type="text" placeholder="First Name" />
                                </div>
                                <div class="col">
                                    <label>Last Name</label>
                                    <input type="text" placeholder="Last Name" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" placeholder="your@email.com" />
                            </div>
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="tel" placeholder="+91 XXXXX XXXXX" />
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>Pincode</label>
                                    <input type="text" placeholder="Pincode" />
                                </div>
                                <div class="col">
                                    <label>Landmark</label>
                                    <input type="text" placeholder="Nearby landmark" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Full Address</label>
                                <input type="text" placeholder="House / Street / Area" />
                            </div>
                            <button type="submit" class="btn-primary" style="border:none;cursor:pointer;"><i
                                    class="fas fa-save" style="margin-right:6px;"></i> Save Details</button>
                        </form>
                    </div> <!-- End tab-personal -->


                    <!-- ACCOUNT SETTINGS TAB -->
                    <div id="tab-account" class="tab-pane active" style="margin-top:40px;">
                        <h2 class="tab-title">Account Settings</h2>
                        <form class="profile-form" onsubmit="event.preventDefault(); alert('Password Updated!');">
                            <div class="form-group">
                                <label>Email ID</label>
                                <input type="email" placeholder="your@email.com" />
                            </div>
                            <div class="form-group">
                                <label>Current Password</label>
                                <input type="password" placeholder="Enter current password" />
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label>New Password</label>
                                    <input type="password" placeholder="New password" />
                                </div>
                                <div class="col">
                                    <label>Confirm Password</label>
                                    <input type="password" placeholder="Confirm new password" />
                                </div>
                            </div>
                            <button type="submit" class="btn-primary" style="border:none;cursor:pointer;"><i
                                    class="fas fa-lock" style="margin-right:6px;"></i> Update Account</button>
                        </form>
                    </div> <!-- End tab-account -->


                </div> <!-- End profile-content -->
            </div> <!-- End profile-layout -->
        </div>
    </section>

    <div class="ornament-divider" style="margin: 0 0 40px; text-align: center; color: var(--saffron);"><i class="fas fa-om"></i></div>

@endsection