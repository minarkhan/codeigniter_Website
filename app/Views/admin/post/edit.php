<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-12">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('/admin/dashboard') ?>">Home</a></li>
              <li class="breadcrumb-item active"><a href="<?= base_url('/admin/post/add') ?>">Add Post</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      	<!-- form start -->
          <form method="post" enctype="multipart/form-data" action="<?= $post_info->post_id ?>">
          	<?= csrf_field() ?>
        	<div class="row">

    	
          <!-- left column -->
	          <div class="col-md-7">
	            <!-- general form elements -->
	            <div class="card card-primary">
	              <div class="card-header">
	                <h3 class="card-title">Main Info</h3>
	              </div>
	              <!-- /.card-header -->
	              
	                <div class="card-body">

	                  <div class="form-group">
	                    <label for="exampleInputEmail1">Tiêu Đề</label>
	                    <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Enter Tiêu Đề" value="<?= $post_info->post_title ?>">
	                  </div>

	                  <div class="form-group">
	                    <label>Giới Thiệu</label>
	                    <textarea class="form-control" name="intro" rows="3" placeholder="Enter ..." maxlength="50"><?= $post_info->post_intro ?></textarea>
	                  </div>



				        <!-- /.col-->
				        <div class="form-group">
				          <div class="card">
				            <div class="card-body bg-primary">
				            	<h5 class="card-title">Nội Dung</h5>
				            </div>
				            <!-- /.card-header -->
				            <textarea class="textarea" id="content" name="content" placeholder="Place some text here" ><?= $post_info->post_content ?></textarea>
				          </div>
				        </div>

				        <script>
						    CKEDITOR.replace( 'content',
								 {
								     filebrowserBrowseUrl: '<?= base_url('/'); ?>/public/editor/ckfinder/ckfinder.html',
								     uploadUrl: '<?= base_url('/'); ?>/public/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
								     filebrowserImageBrowseUrl: '<?= base_url('/'); ?>/public/editor/ckfinder/ckfinder.html',
								     filebrowserUploadUrl: '<?= base_url('/'); ?>/public/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
								     filebrowserImageUploadUrl: '<?= base_url('/'); ?>/public/editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
								 });
						</script>


	                  <div class="form-group">
	                    <label>Meta Key</label>
	                    <textarea class="form-control" name="meta_key" rows="3" placeholder="Enter ..." maxlength="255"><?= $post_info->meta_key ?></textarea>
	                  </div>

	                  <div class="form-group">
	                    <label>Meta Desc</label>
	                    <textarea class="form-control" name="meta_desc" rows="3" placeholder="Enter ..." maxlength="255"><?= $post_info->meta_desc ?></textarea>
	                  </div>

	                  

	                  

	                </div>
	                <!-- /.card-body -->
	              
	            </div>
	            <!-- /.card -->

	          </div>
	          <!--/.col (left) -->



	          <!-- right column -->
	          <div class="col-md-5">
	            <!-- general form elements disabled -->
	            <div class="card card-warning">
	              <div class="card-header">
	                <h3 class="card-title">More Info</h3>
	              </div>
	              <!-- /.card-header -->
	              <div class="card-body">
	                
	                  <div class="row">

	                    <div class="col-sm-12">
	                      <!-- radio -->
	                      <label>Trạng Thái</label>
	                      <div class="form-group">
	                        <div class="form-check">
	                          <input class="form-check-input" type="radio" name="featured" value="1" <?php if($post_info->post_featured	== 1){echo 'checked';} ?>>
	                          <label class="form-check-label">Bài Viết Nổi Bật</label>
	                        </div>
	                        <div class="form-check">
	                          <input class="form-check-input" type="radio" name="featured" value="0" <?php if($post_info->post_featured	== 0){echo 'checked';} ?>>
	                          <label class="form-check-label">Không</label>
	                        </div>
	                      </div>
	                    </div>
	                  </div>

	                  <div class="row">
	                    <div class="col-sm-12">
	                      <!-- select -->
	                      <div class="form-group">
	                        <label>Lựa Chọn Menu</label>
	                        <select class="form-control" name="cate">
	                        	<?php foreach($cate as $key): ?>

				                    <?php foreach($cate as $key3): ?>
				                      <?php $array_key[] = $key3['parent_cate_id']; ?>

				                    <?php endforeach; ?>


				                    <?php if($key['parent_cate_id'] == 0 && in_array($key['cate_id'], $array_key) == FALSE): ?>
				                      <option value="<?= $key['cate_id'] ?>" <?php if($post_info->post_cate_id == $key['cate_id']){echo 'selected';} ?>><?= $key['cate_name']; ?></option>
				                    <?php elseif($key['parent_cate_id'] == 0 && in_array($key['cate_id'], $array_key) == TRUE): ?>


				                        <?php $id_sub = $key['cate_id']; ?>
				                        <optgroup label="<?= $key['cate_name']; ?>">
				                        

				                          <?php foreach($cate as $key2): ?>
				                            <?php if($key2['parent_cate_id'] == $id_sub): ?>
				                              <option value="<?= $key2['cate_id'] ?>" <?php if($post_info->post_cate_id == $key2['cate_id']){echo 'selected';} ?>><?= $key2['cate_name']; ?></option>
				                            <?php endif; ?>
				                          <?php endforeach; ?>


				                        </optgroup>


				                    <?php endif; ?>

				                <?php endforeach; ?>


	                        	
	                          
	                        </select>
	                      </div>
	                    </div>

	                  </div>

	                  <div class="form-group">
	                    <label for="exampleInputEmail1">Tag</label>
	                    <input type="text" name="tag_input" class="form-control" id="exampleInputEmail1" value="<?= $post_info->post_tag; ?>">

	                  </div>

	                  <div class="form-group" >
	                  	<label for="exampleInputFile">Ảnh sản phẩm</label>
						<input type="file" name="image" id="img" class="input-group custom-file"  class="form-control hidden" onchange="changeImg(this)">
						<img id="avatar" class="thumbnail" width="300px" src="<?php echo base_url('public'); ?>/upload/post/<?= $post_info->post_image ?>">
	                  </div>


	                
	              </div>
	              <!-- /.card-body -->
	            </div>
	            <!-- /.card -->

	            <!-- /.card -->
	          </div>
	          <!--/.col (right) -->
	          <div class="col-lg-12 mb-3">
	          	<div class="card-footer">
                  <button type="submit" class="btn btn-success">Update</button>
                  <button type="submit" class="btn btn-secondary">Cancel</button>
                </div>
	          </div>
          
	        </div>
	        <!-- /.row -->
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->



<?= $this->endSection() ?>