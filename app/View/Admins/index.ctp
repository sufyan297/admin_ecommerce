<?php $this->start('main-content'); ?>
<section class="content-header">
      <h1>Dashboard<small>Control panel</small></h1>
</section>

<section class="content">


    <div class="row">
      <div class="col-lg-2 col-xs-6">
          <div class="small-box bg-green">
              <div class="inner">
                  <h3>
                    <?= $admins_count ?>
                  </h3>
                  <p>
                    Total Admins
                  </p>
              </div>
              <div class="icon">
                  <i class="fa fa-user-secret"></i>
              </div>
              <a href="<?= $this->webroot. 'admins/view'; ?>" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
              </a>
          </div>
      </div>

      <div class="col-lg-2 col-xs-6">
          <div class="small-box bg-yellow">
              <div class="inner">
                  <h3>
                    <?= $categories_count ?>
                  </h3>
                  <p>
                    Total Item Categories
                  </p>
              </div>
              <div class="icon">
                  <i class="fa fa-tag"></i>
              </div>
              <a href="<?= $this->webroot. 'item_category/view'; ?>" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
              </a>
          </div>
      </div>

      <div class="col-lg-2 col-xs-6">
          <div class="small-box bg-purple">
              <div class="inner">
                  <h3>
                    <?= $items_count ?>
                  </h3>
                  <p>
                    Total Items
                  </p>
              </div>
              <div class="icon">
                  <i class="fa fa-list-ul"></i>
              </div>
              <a href="<?= $this->webroot. 'items/view'; ?>" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
              </a>
          </div>
      </div>

      <div class="col-lg-2 col-xs-6">
          <div class="small-box bg-orange">
              <div class="inner">
                  <h3>
                    <?= $variants_count ?>
                  </h3>
                  <p>
                    Total Variants
                  </p>
              </div>
              <div class="icon">
                  <i class="fa fa-sitemap"></i>
              </div>
              <a href="<?= $this->webroot. 'variants/view'; ?>" class="small-box-footer">
                More info <i class="fa fa-arrow-circle-right"></i>
              </a>
          </div>
      </div>

	</div>
</section>
<?php $this->end('main-content'); ?>
