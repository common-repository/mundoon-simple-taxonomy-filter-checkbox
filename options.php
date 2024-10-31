<?php
add_action( 'admin_menu', 'mundoon_simple_taxonomie_filter_menu' );
function mundoon_simple_taxonomie_filter_menu(){
	add_submenu_page(
		'options-general.php',
		'Configurações',
		'Mundoon Filter',
		'manage_options',
		'mundoon-simple-taxonomie-filter',
		'mundoon_simple_taxonomie_filter_page'
	);
}
function mundoon_simple_taxonomie_filter_page() {
	?>
		<div class="wrap">
			<div class="mundoon">
				
				<div class="header">
					<div class="title">Simple Taxonomie Filter</div>
					<div class="title-text">Quickly create taxonomies filters for custom post types templates.</div>
				</div>
				<?php  $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'taxonomias';  ?>  
				<div class="tabs">
					<a href="?page=mundoon-simple-taxonomie-filter&tab=taxonomias" class="tab <?php echo $active_tab == 'taxonomias' ? 'active' : ''; ?>">Taxonomias</a>
				</div>
				<?php
					$cpts = get_post_types(['_builtin'=> false, 'capability_type' => 'post'], 'objects');
					$cpts_infos = [];
					foreach ($cpts as $cpt) {
						$name = $cpt->labels->name;
						$slugs = $cpt->name;
						if ($name != 'Campos' && $name != 'Grupos de Campos') {
							$cpts_infos[$slugs] = $name;
						}
					}
			  	?>
				<?php if ($active_tab == 'taxonomias'): ?>
				<div class="tab-content">
					<form method="post" action="options.php">
						<?php
							$mo_stf_option = get_option('mundoon-stf-options');
							settings_fields('mundoon-stf-options');
							foreach ($cpts_infos as $key => $label) {
								$taxs_cpt = get_object_taxonomies( $key, 'objects' );
								$n_tax = count($taxs_cpt);
								if ($n_tax > 0) {
									?>
									<div class="box">
										<div class="box-header">
											<div class="title"><?php echo $label; ?></div>
											<div class="texto">Selecione as taxonomias ao qual você quer como filtros.</div>
										</div>
										<div class="lista-itens">
											<?php foreach ($taxs_cpt as $tax) : ?>
												<div class="item">
													<div class="filtro">
														<div class="tax"><?php echo $tax->name; ?></div>
														<div class="tax-title">
															<input value="<?php echo $tax->labels->name; ?>" name="mundoon-stf-options[<?php echo $key.'-'.$tax->name.'-label' ?>]" type="text" value="<?php echo $mo_stf_option[$key.'-'.$tax->name.'-label']; ?>" />
														</div>
														<div class="check-item">
															<div class="mo-checkbox">
																<input id="<?php echo $key; ?>-<?php echo $tax->name; ?>" name="mundoon-stf-options[<?php echo $key.'-'.$tax->name; ?>]" type="checkbox" value="1" <?php checked(isset($mo_stf_option[$key.'-'.$tax->name]), 1); ?>>
																<label for="<?php echo $key; ?>-<?php echo $tax->name; ?>"></label>
															</div>
														</div>
													</div>
												</div>
											<?php endforeach; ?>
										</div>
									</div>
									<?
								}
							}
						?>
						<?php submit_button('Salvar', 'button-hero primary'); ?>
					</form>
				</div>
				<?php endif; ?>
				<?php if ($active_tab == 'configuracoes'): ?>
				<div class="tab-content">
				</div>
				<?php endif; ?>
			</div>
		</div>
	<?
}
function mundoon_simple_taxonomie_filter_page_register_options(){
	register_setting('mundoon-stf-options', 'mundoon-stf-options');
}
add_action('admin_init', 'mundoon_simple_taxonomie_filter_page_register_options');