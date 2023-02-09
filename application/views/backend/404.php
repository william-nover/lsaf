<body>
<?php include VIEWS_PATH_BACKEND."/menu.php"; ?>
<div id="wrapper-body">
    <div id="container-body">
    	<ol class="breadcrumb">
          <li><a href="<?php echo BASE_URL_BACKEND.'/home'; ?>">Home</a></li>
          <li class="active">Access Management</li>
          <li><a href="<?php echo BASE_URL_BACKEND.'/userlevel'; ?>">User Level</a></li>
          <li class="active">Add</li>
        </ol>

        <div class="pull-left" style="width:240px; font-size:11px;">
            <?php include VIEWS_PATH_BACKEND."/leftMenu.php"; ?>
        </div>
        <div class="pull-left" style="margin-left:20px;">
			<div style="min-width:1024px;">
				<div class="panel panel-warning">
					<div class="panel-heading">
					  <h3 class="panel-title">Add User Level</h3>
					</div>
					<div class="panel-body">
						<?php if(isset($error)){ ?>
						<div class="alert alert-danger" align="center">
							<strong><?php echo $error;?></strong>
						</div>
						<?php } ?>
						<form name="form1" action="<?php echo BASE_URL_BACKEND.'/userlevel/doAdd'; ?>" method="post">
							<div class="form-group">
								<label>User Level Name</label>
								<input name="userlevelname" type="text" class="form-control input-sm" placeholder="User Level Name" style="width:300px;" value="<?php if(!empty($userlevelname)){echo $userlevelname;} ?>">
							</div>
							<div class="form-group">
								<label>User Level Description </label>
								<textarea name="userleveldesc" class="form-control input-sm" placeholder="User Level Description" rows="5"><?php if(!empty($userleveldesc)){echo $userleveldesc;} ?></textarea>
							</div>
							<div style="margin-top:10px;">
								<input name="tbSave" class="btn btn-warning btn-sm" type="submit" value="Save">&nbsp;
								<input name="cancel" class="btn btn-warning btn-sm" type="button" value="Cancel" onClick="location.href='<?php echo BASE_URL_BACKEND.'/userlevel'; ?>'">
							</div>
						</form>
					</div>	
				</div>
			</div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php include VIEWS_PATH_BACKEND."/footer.php"; ?>
</body>
</html>
