<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?=ucfirst($child_nav)?></h2>
        <ol class="breadcrumb">
            <li>
                <a href="#"><?= ucfirst($parent_nav)?></a>
            </li>
            <li class="<?=(empty($header_title))?"active":""?>">
              <?php if (empty($header_title)) {?>
                <strong><?= ucfirst($child_nav)?></strong>
              <?php
            }else{
              if($child_nav === 'GPS Hunt'){?>
                <a href='<?=base_url();?>admin/promo'><?= ucfirst($child_nav)?></a>
              <?php
              }else{?>
                <a href='<?=base_url();?>admin/<?=$child_nav?>'><?= ucfirst($child_nav)?></a>
            <?php
              }
            }?>
            </li>
            <?php  if (!empty($header_title)) {?>
              <li class="active">
                  <strong><?= ucfirst($header_title)?></strong>
              </li>
            <?php
            }?>
        </ol>
    </div>
    <div class="col-sm-8">
      <?php if($child_nav === 'user'){?>
        <div class="title-action"></div>
      <?php
        }elseif (!empty($header_title)) {?>
          <div class="title-action"></div>
      <?php
        }else{?>
          <div class="title-action">
            <a href="" id="add-new-item-button" class="btn btn-primary" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modal"><span class="fa fa-plus"></span>&nbsp;&nbsp;Add new <?=$child_nav?></a>
          </div>
      <?php
      }?>
    </div>
</div>
