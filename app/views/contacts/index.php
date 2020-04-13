<div class="div-h1">
	<h1>Contact List</h1>
</div>


<div class="ui grid">
	<div class="two wide column">

		<div class="ui icon vertical right floated buttons">
		    <button id="btn_new"  class="ui green button" title="Novo"><i class="large plus middle aligned icon"></i></button>
		    <button id="btn_view" class="ui olive button" title="Ver"><i class="large unhide middle aligned icon"></i></button>
		    <button id="btn_edit" class="ui blue button"  title="Editar"><i class="large edit middle aligned icon"></i></button>
		    <button id="btn_del"  class="ui red button"   title="Excluir"><i class="large trash middle aligned icon"></i></button>
		</div>
		
	</div>
	<div class="fourteen wide column" style="padding-right: 30px">

	    <div class="ui fluid category search block">
		    <div class="ui icon input content-field">
		        <input id="search" class="prompt field-search" type="text" placeholder="Search...">
		        <i class="search icon"></i>
		    </div>
		</div>
		<table id="table-contacts" class="ui table">
			<thead>
				<tr>
					<th>Name</th>
					<th>E-mail</th>
					<th>Cell Phone</th>
				</tr>
			</thead>
			<tbody>
				<?php echo $data['tpl_contacts']; ?>
			</tbody>
		</table>

	</div>
</div>

<!-- Viewer Contact Modal -->

<div id="viewer-contact" class="ui small modal">
  	<!-- <i class="close icon"></i> -->
  	<div class="header">
    	View Contact
  	</div>
  	<div class="image content">
    	<div class="ui medium image">
			<img src="<?php echo assests('img/avatar.png'); ?>">
    	</div>
		<div class="description">
	  		<div id="message-m"></div>
		   	<h3>Datails</h3>
      		<p><b>Name:</b> <span id="name-m"></span> </p>
      		<p><b>Address:</b> <span id="address-m"></span> </p>
      		<p><b>Cell Phone:</b> <span id="cell-phone-m"></span> </p>
      		<p><b>Email:</b> <span id="email-m"></span> </p>
      		<p><b>Create at:</b> <span id="create-at-m"></span> </p>
    	</div>
  	</div>
  	<div class="actions">
    	<div class="ui positive ok button">Close</div>
  	</div>
</div>

<!-- Show Form Contact Modal for New/Update register -->

<div id="form-contact-m" class="ui small modal">
	<!-- <i class="close icon"></i> -->
	<div class="header">
		New Contact
	</div>
	<div class="content">
		
		<form autocomplete="off" name="form_contacts" id="form-contacts" action="" method="post" enctype="multipart/data-from" class="form-contacts ui form">
			<input type="hidden" id="code"      name="code"      placeholder="Código"  class="margin-input" value="0">
			<input type="text"   id="name"      name="name"      placeholder="Name"    class="margin-input">
			<input type="text"   id="address"   name="address"   placeholder="Address" class="margin-input">
			<input type="email"  id="email"     name="email"     placeholder="E-mail"  class="margin-input">
			<input type="text"   id="cellphone" name="cellphone" placeholder="Cell Phone">
			
			<span>&nbsp;</span> <div id="message"></div>
			
			<div class="buttons">
				<button type="reset"  id="btn_reset" class="ui button">Reset</button>
				<button type="submit" id="btn_save"  class="ui primary button"><i class="check icon"></i>Save</button>

			</div>
		</form>

		<div id="alert-loader" class="ui disable dimmer">
			<div class="ui indeterminate text loader">Wait</div>
		</div>
		
	</div>
</div>