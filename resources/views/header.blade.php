     <div class="header">
         <div class="page-title">{{ $pageTitle }}</div>
         <div class="user-menu">
             <div class="notification-bell">
                 <i class="fas fa-bell"></i>
                 <span class="notification-badge">3</span>
             </div>
             <div class="user-avatar">
                 <img src="{{ asset('storage/admins/' . Auth::guard('admin')->user()->image) }}" alt="User Avatar" />
             </div>
         </div>
     </div>
