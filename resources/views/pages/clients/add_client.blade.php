<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/pages/clients/add_client.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>
    <div class="main-content">
        {{-- Header --}}
        <div class="header">
            <h1 class="page-title">Add New Client</h1>
            {{-- <div class="user-menu">
                <div class="notification-bell">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </div>
                <div class="user-avatar">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User Avatar" />
                </div>
            </div> --}}
        </div>

        {{-- Client Form --}}
        <div class="form-container">
            <div class="form-header">
                <h2 class="form-title">Client Information</h2>
            </div>

            <form id="clientForm" action="client_data" method="post" enctype="multipart/form-data">
                @csrf
                {{-- Avatar Upload --}}
                <div class="avatar-upload">
                    <div class="avatar-preview" id="avatarPreview">
                        <div class="avatar-placeholder">
                            <i class="fas fa-user"></i>
                        </div>
                        <img id="avatarImage" style="display: none;" />
                    </div>
                    <div class="avatar-upload-btn">
                        <button type="button" class="btn-upload">
                            <i class="fas fa-upload"></i> Upload Photo
                        </button>
                        <input type="file" id="avatarInput" accept="image/*" name="image"/>
                    </div>
                </div>

                {{-- Personal Information --}}
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" id="firstName" class="form-control" placeholder="Enter first name"
                                name="name">
                            <span style="color: red">
                                @error('fname')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    {{-- <div class="form-col">
                        <div class="form-group">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" id="lastName" class="form-control" placeholder="Enter last name"
                                name="lname">
                        </div>
                    </div> --}}
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" class="form-control" placeholder="Enter email address"
                        name="email">
                    <span style="color: red">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" id="phone" class="form-control" placeholder="Enter phone number"
                        name="phone">
                    <span style="color: red">
                        @error('phone')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                {{-- Company Information --}}
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label for="company" class="form-label">Company</label>
                            <select id="company" class="form-control form-select" name="company">
                                <option value="">Select company</option>
                                <option value="Acme Corporation">Acme Corporation</option>
                                <option value="Bright Solutions">Bright Solutions</option>
                                <option value="Tech Innovators">Tech Innovators</option>
                                <option value="Global Designs">Global Designs</option>
                                <option value="North Industries">North Industries</option>
                                <option value="other">Other</option>
                            </select>
                            <span style="color: red">
                                @error('company')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group" id="otherCompanyGroup" style="display: none;">
                            <label for="otherCompany" class="form-label">Company Name</label>
                            <input type="text" id="otherCompany" class="form-control"
                                placeholder="Enter company name">
                        </div>
                    </div>
                </div>

                {{-- Status --}}
                {{-- <div class="form-group">
                    <div class="status-toggle">
                        <span class="toggle-label">Status:</span>
                        <label class="toggle-switch">
                            <input type="checkbox" id="statusToggle" checked>
                            <span class="toggle-slider"></span>
                        </label>
                        <span id="statusText">Active</span>
                    </div>
                </div> --}}

                {{-- Form Actions --}}
                <div class="form-actions">
                    <button type="button" class="btn btn-outline">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Client
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
