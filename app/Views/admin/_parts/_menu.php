<div class="side-menu">
  <nav id="sidebar">
    <div class="mobile-menu-close">
      <i class="fa-solid fa-xmark"></i>
    </div>

    <div class="sidebar-header">
      <img class="navbar-brand-img" src="<?= base_url('assets/img/temp_logo.jpg')?>">
      <span class="sub-logo">OTT</span>
    </div>

    <ul class="list-unstyled components left-menu-ul">
      <li>
        <a href="<?= base_url('admin/dashboard')?>"><i class="fa-solid fa-gauge-high"></i> Dashboard</a>
      </li>

      <li>
        <a href="<?= base_url('admin/members/1')?>"><i class="fa-solid fa-user-group"></i> Member</a>
      </li>

      <li class="nav-item">
        <a class="nav-link submenu-toggle" href="#" data-target="#mediaSubmenu" data-toggle="collapse" aria-expanded="false" aria-controls="collapsePages">
          <i class="fa-solid fa-folder-open"></i>
          <span>Media</span>
        </a>
        <div class="collapse submenu" id="mediaSubmenu">
          <div class="collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url('admin/media-content/1')?>"><i class="fa-solid fa-photo-film me-1"></i> Media Content</a>
            <a class="collapse-item" href="<?= base_url('admin/media-category')?>"><i class="fa-solid fa-layer-group me-1"></i> Media Category</a>
            <a class="collapse-item" href="<?= base_url('admin/media-genre')?>"><i class="fa-solid fa-clapperboard me-1"></i> Media Genre</a>
          </div>
        </div>
      </li>
      <li>
        <a href="<?= base_url('admin/payment-transaction/1') ?>">
          <i class="fa-solid fa-money-bill-transfer"></i> Payment Transaction
        </a>
      </li>

      <li>
        <a href="<?= base_url('admin/package')?>"><i class="fa-solid fa-boxes-packing"></i> Package & Plan</a>
      </li>

      <li>
        <a href="<?= base_url('admin/promo-codes') ?>">
          <i class="fa-solid fa-ticket-simple"></i> Promo Codes
        </a>
      </li>
      <li>
        <a href="<?= base_url('admin/home-page-setup/default') ?>">
          <i class="fa-solid fa-photo-film"></i> Banner Setup
        </a>
      </li>

      <!-- <li class="nav-item">
        <a class="nav-link submenu-toggle" href="#" data-target="#homepagesetupSubmenu" data-toggle="collapse" aria-expanded="false" aria-controls="collapsePages">
          <i class="fa-solid fa-folder-open"></i>
          <span>Home Page Setup</span>
        </a>
        <div class="collapse submenu" id="homepagesetupSubmenu">
          <div class="collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url('admin/home-page-setup/trending')?>"><i class="fa-solid fa-house-laptop"></i> Sections Setup</a>
            <a class="collapse-item" href="<?= base_url('admin/home-page-banner/main')?>"><i class="fa-solid fa-photo-film"></i> Banners</a>
            
          </div>
        </div>
      </li> -->
 

      <li>
        <a href="<?= base_url('admin/payment-gateway') ?>">
          <i class="fa-solid fa-credit-card"></i> Payment Gateway
        </a>
      </li>
      

      <!-- <li>
        <a href="#"><i class="fa-solid fa-screwdriver-wrench"></i> System Config</a>
      </li> -->
    </ul>
  </nav>
</div>

<?= $this->section('js')?>
<script src="<?php echo base_url('assets/js/_routes.js?v='.date('dmyHi'))?>"></script>
<script src="<?php echo base_url('assets/js/admin.js?v='.date('dmyHi'))?>"></script>
<script src="<?php echo base_url('assets/js/_media_content.js?v='.date('dmyHi'))?>"></script>
<script src="<?php echo base_url('assets/js/_payment_gateway.js?v='.date('dmyHi'))?>"></script>
<script src="<?php echo base_url('assets/js/_home_page_setup.js?v='.date('dmyHi'))?>"></script>
<?= $this->endSection()?>
