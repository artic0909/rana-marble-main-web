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
                    <!-- Logout -->
                    <form action="{{ route('customer.logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-primary"
                            style="border:none;cursor:pointer;background:linear-gradient(135deg,#e74c3c,#c0392b);margin-bottom:20px;">
                            <i class="fas fa-sign-out-alt" style="margin-right:6px;"></i> Logout
                        </button>
                    </form>
                    <form class="profile-form" action="{{ route('customer.profile.update') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" placeholder="Full Name"
                                value="{{ Auth::guard('customer')->user()->name ?? '' }}" />
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" placeholder="your@email.com"
                                value="{{ Auth::guard('customer')->user()->email ?? '' }}" readonly />
                        </div>
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="tel" name="phone" placeholder="+91 XXXXX XXXXX"
                                value="{{ Auth::guard('customer')->user()->phone ?? '' }}" />
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Pincode</label>
                                <input type="text" name="pincode" placeholder="Pincode"
                                    value="{{ Auth::guard('customer')->user()->pincode ?? '' }}" />
                            </div>
                            <div class="col">
                                <label>Landmark</label>
                                <input type="text" name="landmark" placeholder="Nearby landmark"
                                    value="{{ Auth::guard('customer')->user()->landmark ?? '' }}" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>City</label>
                                <input type="text" name="city" placeholder="City"
                                    value="{{ Auth::guard('customer')->user()->city ?? '' }}" />
                            </div>
                            <div class="col">
                                <label>State</label>
                                <input type="text" name="state" placeholder="State"
                                    value="{{ Auth::guard('customer')->user()->state ?? '' }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Full Address</label>
                            <input type="text" name="address" placeholder="House / Street / Area"
                                value="{{ Auth::guard('customer')->user()->address ?? '' }}" />
                        </div>
                        <button type="submit" class="btn-primary" style="border:none;cursor:pointer;"><i
                                class="fas fa-save" style="margin-right:6px;"></i> Save Details</button>
                    </form>
                </div> <!-- End tab-personal -->


                <!-- ACCOUNT SETTINGS TAB -->
                <div id="tab-account" class="tab-pane active" style="margin-top:40px;">
                    <h2 class="tab-title">Account Settings</h2>

                    {{-- Success / Error messages --}}
                    @if(session('password_success'))
                    <div style="background:rgba(39,174,96,0.1);border:1px solid #27ae60;color:#27ae60;
            border-radius:6px;padding:12px 16px;margin-bottom:20px;
            font-family:'Crimson Pro',serif;font-size:0.95rem;display:flex;align-items:center;gap:8px;">
                        <i class="fas fa-check-circle"></i> {{ session('password_success') }}
                    </div>
                    @endif

                    @if(session('password_error'))
                    <div style="background:rgba(231,76,60,0.1);border:1px solid #e74c3c;color:#e74c3c;
            border-radius:6px;padding:12px 16px;margin-bottom:20px;
            font-family:'Crimson Pro',serif;font-size:0.95rem;display:flex;align-items:center;gap:8px;">
                        <i class="fas fa-exclamation-circle"></i> {{ session('password_error') }}
                    </div>
                    @endif

                    <form class="profile-form" action="{{ route('customer.password.update') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Email ID</label>
                            <input type="email"
                                value="{{ Auth::guard('customer')->user()->email ?? '' }}"
                                readonly
                                style="background:#f5f5f5;cursor:not-allowed;opacity:0.7;" />
                        </div>

                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password"
                                name="current_password"
                                placeholder="Enter current password"
                                required />
                            @error('current_password')
                            <span style="color:#e74c3c;font-size:0.82rem;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                <label>New Password</label>
                                <input type="password"
                                    name="new_password"
                                    placeholder="New password (min 8 chars)"
                                    required />
                                @error('new_password')
                                <span style="color:#e74c3c;font-size:0.82rem;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col">
                                <label>Confirm Password</label>
                                <input type="password"
                                    name="new_password_confirmation"
                                    placeholder="Confirm new password"
                                    required />
                            </div>
                        </div>

                        <button type="submit" class="btn-primary" style="border:none;cursor:pointer;">
                            <i class="fas fa-lock" style="margin-right:6px;"></i> Update Password
                        </button>
                    </form>
                </div><!-- End tab-account -->


            </div> <!-- End profile-content -->
        </div> <!-- End profile-layout -->
    </div>
</section>

<div class="ornament-divider" style="margin: 0 0 40px; text-align: center; color: var(--saffron);"><i class="fas fa-om"></i></div>

@endsection