<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/cart/profile.css', 'resources/js/app.js'])
    <title>Document</title>
</head>

<body>
    <!-- Header -->
    <header class="main-header">
        <div class="header-container">
            <a href="#" class="logo">
                <i class="fas fa-laptop-code"></i>
                <span>TechShop</span>
            </a>
            <nav class="main-nav">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#" class="active">Profile</a></li>
                    <li><a href="#">Orders</a></li>
                </ul>
            </nav>
            <div class="header-actions">
                <div class="profile-btn">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile" class="profile-img">
                    <span class="profile-name">Sarah</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="profile-container">
        <!-- Profile Sidebar -->
        <aside class="profile-sidebar">
            <div class="profile-card">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile" class="profile-avatar">
                <h2 class="profile-name-large">Sarah Johnson</h2>
                <p class="profile-email">sarah.johnson@example.com</p>
                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="stat-number">24</div>
                        <div class="stat-label">Orders</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">12</div>
                        <div class="stat-label">Wishlist</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">5</div>
                        <div class="stat-label">Reviews</div>
                    </div>
                </div>
            </div>
            <ul class="profile-menu">
                <li><a href="#" class="active"><i class="fas fa-user"></i> Personal Info</a></li>
                <li><a href="#"><i class="fas fa-shopping-bag"></i> Orders</a></li>
                <li><a href="#"><i class="fas fa-heart"></i> Wishlist</a></li>
                <li><a href="#"><i class="fas fa-map-marker-alt"></i> Addresses</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Settings</a></li>
                <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>

        <!-- Profile Content -->
        <section class="profile-content">
            <div class="profile-header">
                <h1 class="profile-title">Personal Information</h1>
                <button class="edit-btn"><i class="fas fa-edit"></i> Edit Profile</button>
            </div>

            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Full Name</span>
                    <div class="info-value">Sarah Johnson</div>
                </div>
                <div class="info-item">
                    <span class="info-label">Email Address</span>
                    <div class="info-value">sarah.johnson@example.com</div>
                </div>
                <div class="info-item">
                    <span class="info-label">Phone Number</span>
                    <div class="info-value">+1 (555) 123-4567</div>
                </div>
                <div class="info-item">
                    <span class="info-label">Date of Birth</span>
                    <div class="info-value">March 15, 1990</div>
                </div>
                <div class="info-item">
                    <span class="info-label">Gender</span>
                    <div class="info-value">Female</div>
                </div>
                <div class="info-item">
                    <span class="info-label">Member Since</span>
                    <div class="info-value">January 2022</div>
                </div>
            </div>

            <div class="order-history">
                <h2 class="profile-title">Recent Orders</h2>
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#TS-78945</td>
                            <td>Nov 12, 2023</td>
                            <td>3</td>
                            <td>$456.99</td>
                            <td><span class="order-status status-completed">Completed</span></td>
                            <td><a href="#" class="view-order">View</a></td>
                        </tr>
                        <tr>
                            <td>#TS-78123</td>
                            <td>Nov 5, 2023</td>
                            <td>2</td>
                            <td>$299.99</td>
                            <td><span class="order-status status-shipped">Shipped</span></td>
                            <td><a href="#" class="view-order">View</a></td>
                        </tr>
                        <tr>
                            <td>#TS-77654</td>
                            <td>Oct 28, 2023</td>
                            <td>1</td>
                            <td>$129.99</td>
                            <td><span class="order-status status-processing">Processing</span></td>
                            <td><a href="#" class="view-order">View</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="wishlist-section">
                <h2 class="profile-title">Your Wishlist</h2>
                <div class="wishlist-grid">
                    <div class="wishlist-item">
                        <img src="https://via.placeholder.com/300x200?text=MacBook+Pro" alt="Product"
                            class="wishlist-img">
                        <div class="wishlist-info">
                            <h3 class="wishlist-name">MacBook Pro 14" M2</h3>
                            <div class="wishlist-price">$1,999.00</div>
                            <div class="wishlist-actions">
                                <button class="add-to-cart">Add to Cart</button>
                                <button class="remove-wishlist"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="wishlist-item">
                        <img src="https://via.placeholder.com/300x200?text=iPhone+15" alt="Product"
                            class="wishlist-img">
                        <div class="wishlist-info">
                            <h3 class="wishlist-name">iPhone 15 Pro</h3>
                            <div class="wishlist-price">$999.00</div>
                            <div class="wishlist-actions">
                                <button class="add-to-cart">Add to Cart</button>
                                <button class="remove-wishlist"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="wishlist-item">
                        <img src="https://via.placeholder.com/300x200?text=AirPods+Pro" alt="Product"
                            class="wishlist-img">
                        <div class="wishlist-info">
                            <h3 class="wishlist-name">AirPods Pro (2nd Gen)</h3>
                            <div class="wishlist-price">$249.00</div>
                            <div class="wishlist-actions">
                                <button class="add-to-cart">Add to Cart</button>
                                <button class="remove-wishlist"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        // Interactive elements
        document.querySelector('.edit-btn').addEventListener('click', function() {
            // Convert info values to editable inputs
            const infoValues = document.querySelectorAll('.info-value');
            infoValues.forEach(value => {
                const currentValue = value.textContent;
                value.innerHTML = `<input type="text" value="${currentValue}" class="edit-input">`;
            });

            // Change button to save
            this.innerHTML = '<i class="fas fa-save"></i> Save Changes';
            this.classList.add('save-btn');

            // Change button action
            this.onclick = function() {
                alert('Changes saved successfully!');
                // Here you would normally send data to server
            };
        });

        // Add to cart buttons
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const productName = this.closest('.wishlist-item').querySelector('.wishlist-name')
                    .textContent;
                alert(`${productName} added to cart!`);
            });
        });

        // Remove from wishlist buttons
        document.querySelectorAll('.remove-wishlist').forEach(button => {
            button.addEventListener('click', function() {
                const wishlistItem = this.closest('.wishlist-item');
                wishlistItem.style.transform = 'scale(0.9)';
                wishlistItem.style.opacity = '0';
                setTimeout(() => {
                    wishlistItem.remove();
                }, 300);
            });
        });
    </script>
</body>

</html>
