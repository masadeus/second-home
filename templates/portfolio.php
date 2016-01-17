		<div id="categories">
	        <?php for ($i = 0 ;   $i < count($categories); $i++): ?>	        	
		        <div id="list_<?php echo $categories[$i]?>" class="group">
	
			        <!-- category title -->
			        <div id="title_<?php echo $categories[$i]?>">
			        	<h3 class="get_in"><?= $categories[$i] ?></h3>
			        	<form onsubmit="erase_category('<?php echo $categories[$i]?>'); return false;">
				            <button class="ion-trash-b trash_category" contenteditable="false"></button>
				        </form> 
			        </div>
			    
					<!-- list content --> 
					<div id="list_in_<?php echo $categories[$i]?>" class="list">
						<?php $item_count = 0 ?>
					    <?php foreach ($positions as $position):?>
					        <?php if (($position["category"] === $categories[$i]) && ($position["item"] !== "empty")): ?>    
								<?php $item_count++ ?>	
								<ul id="pair_<?php echo $categories[$i]?>_<?php echo $item_count ?>" class="get_in">	
									<li id="q_<?php echo $categories[$i]?>_<?php echo $item_count ?>" class="quantity" ><?= $position["quantity"] ?></li>	            
									<li id="i_<?php echo $categories[$i]?>_<?php echo $item_count ?>" class="item"><?= mb_strtolower($position["item"]) ?></li>
					                <form onsubmit="erase_item('<?php echo mb_strtolower($position["item"])?>', '<?php echo $categories[$i]?>', '<?php echo $item_count?>'); return false;">
							            <button class="ion-trash-b trash_item" contenteditable="false"></button>
							        </form>
							        <button id="b_<?php echo $categories[$i]?>_<?php echo $item_count ?>" onclick="pencil('<?php echo $categories[$i]?>', '<?php echo $item_count ?>'); return false;" class="ion-edit edit_item" contenteditable="false"></button>
								</ul>
					        <?php endif ?>  
						<?php endforeach ?>
					</div>
					<div style="clear: both;"></div> 
					
					<!-- add item form -->
					<form id="form_<?php echo $categories[$i]?>" class="get_in form_items" onsubmit="append_div_item('<?php echo $categories[$i]?>'); add_q_i('<?php echo $categories[$i]?>'); return false;">
						<input id="quantity_<?= $categories[$i]?>" class="add_field_quantity" placeholder="Quantity" autocomplete="off" autofocus/>
				        <input id="item_<?= $categories[$i]?>" class="add_field_item" placeholder="Item" autocomplete="off"/>
				        <input type="submit" name="submit" value="Add" id="add_btn" />
					</form>	
				</div>	
			<?php endfor ?>
		</div>   	
  
		<div id="new_cat_form">
			<form onsubmit="form(new_category.value); add_cat(new_category.value); return false;"> 
				<input class="add_category" id="new_category" placeholder="New category"  autocomplete="off"/>
				<input type="submit" name="submit" value="Add" id="add_btn_category" />
			</form>
		</div>
		