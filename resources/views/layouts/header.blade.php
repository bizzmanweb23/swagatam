<header class="header-wrapper">
   <!-- Navigation -->
   
   <?php $mainUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "https") . "://" . $_SERVER['HTTP_HOST'];?>
   
   <div class="main-navigation ">
      <div class="wrapper-fluid">
         <div class="row">
            <div class="col-es-12">
               <a href="" class="brand">
               <img src="#" alt="LOS" title="LOS"> <strong>image</strong>
               </a>
               <!-- Navigation  -->
               <div class="admin-navigation-container ">
                  <!-- Menu open button -->
                  <a href="javascript:void(0);" class="sidebar-toggle visible-es float-left-es" role="button" style="">
                  <i class="material-icons">menu</i>
                  </a>
                  <!-- /Menu open button -->
                  <ul class="navigation navigation-right top-notification-list">
                     <li class="dropdown">
                        
                        <a href="javascript:void(0);" class="dropdown-toggle">
                        <i class="far fa-bell"></i>
                        <span class="menu-notification-text">&nbsp;</span>
                        </a>
                        <ul class="dropdown-menu notification-all">
                           <li>
                              <ul class="admin-drop-notifiation-list">
                                  <li>
                                      <a href="javascript:void(0);">
                                       <i class="fas fa-bell text-aqua"></i> No Notifications
                                      </a>
                                   </li>
                                 
                              </ul>
                           </li>
                           <li class="align-center"><a href="javascript:void(0)">View all</a></li>
                        </ul>
                     </li>

                     <li class="dropdown right-more-icon">
                        <a href="javascript:void(0);" class="dropdown-toggle">
                        <span class="admin-menu-username">
                        User Name
                        </span>
                        <span class="block">
                           Role name
                        </span>
                        </a>
                        <ul class="dropdown-menu">
                            
                              <li><a href="#">My profile</a></li>
                           
                           <li><a href="#">Change password</a></li>
                           <li>
                              <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                              <form id="logout-form" action="<?php echo $mainUrl.'/logout';?>" method="POST" style="display: none;">
                                 @csrf
                              </form>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </div>
               <!--/Navigation -->
            </div>
         </div>
      </div>
   </div>
   <!-- /Navigation -->
</header>
<aside class="admin-slide-navigation fixed-sidebar">
     <!-- Menu open button -->
     <a href="javascript:void(0);" class="sidebar-toggle hidden-es" role="button">
         <span>
             <div class="menu-close-text">Close</div>
         </span>
     </a>
     <!-- /Menu open button -->

     <div class="slide-navigation-inner scroll">
      <?php
        $mainDashbrdLnk = str_replace('swagatam', '', env('APP_URL'));
      ?>
         <!-- <a href="javascript:void(0);" class="menu-back-link"><i class="material-icons">keyboard_arrow_left</i> Back</a> -->
         <ul class="side-bar-menu ">
            <li class=" active border-bottom mb-1">
              <a href="#" class="dropdown-toggle">
                <i class="fas fa-home"></i> <span class="menu-collapse-heading">Super Admin Dashboard</span>
              </a>
            </li>
            <li class="menu-title">Manage jobs</li>
             <li class="dropdown"><a href="javascript:void(0)" class="dropdown-toggle"><i class="fas fa-file-alt"></i> <span class="menu-collapse-heading">Manage Tools</span></a>
                <ul class="dropdown-menu">
                    <li class="">
                        <a href="{{ url('jobs') }}">
                            <i class="far fa-circle"></i>Post New Job
                        </a>
                    </li>
                    <li class="">
                        <a href="#">
                            <i class="far fa-circle"></i>Sample CRUD
                        </a>
                    </li>
                </ul>
             </li>
              <li class="menu-title">Interview Panel</li>
             <li class="dropdown"><a href="javascript:void(0)" class="dropdown-toggle"><i class="fas fa-file-alt"></i> <span class="menu-collapse-heading">Manage Tools</span></a>
                <ul class="dropdown-menu">
                    <li class="">
                        <a href="{{ url('hr/manage') }}">
                            <i class="far fa-circle"></i>Hr management 
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ url('final/selection') }}">
                            <i class="far fa-circle"></i>Final Selection
                        </a>
                    </li>
                </ul>
             </li>
         </ul> 
     </div>
 </aside>