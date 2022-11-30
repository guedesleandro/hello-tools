<h1 class="wp-heading-title">Grupo TOOLS - <?php bloginfo('site'); ?></h1>
<hr />
<?php if( is_wp_error( $result ) ): ?>
    <div id="message" class="error notice" style="margin: 10px 0;">
        <p><strong><?= $result->get_error_message(); ?></strong></p>
        <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dispensar este aviso.</span></button>
    </div>
<?php elseif( $result === true ): ?>
    <div id="message" class="updated notice" style="margin: 10px 0;">
        <p><strong>Ajustes atualizados com sucesso!</strong></p>
        <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dispensar este aviso.</span></button>
    </div>
<?php endif; ?>

    <form method="post" action="">
        <input type="hidden" name="action" value="save">

        <div id="universal-message-container">
            <h2>Configurações dos Formulários integrados com CRM (WAE)</h2>

            <div class="options">
                <p>
                    <label>Selecione a Escola para integração ao WAE</label>
                    <br />
                    <select name="tools[venue_id]">
                        <option value="">Selecione</option>
                        <option value="1" <?php echo $tools['venue_id'] == 1 ? 'selected' : ''; ?>>Colégio Albert Sabin</option>
                        <option value="3" <?php echo $tools['venue_id'] == 3 ? 'selected' : ''; ?>>Escola AB Sabin</option>
                        <option value="4" <?php echo $tools['venue_id'] == 4 ? 'selected' : ''; ?>>Vital Brazil</option>
                    </select>
                    <?php submit_button(); ?>

                </p>

                <hr />
                
                <p><a href="#" id="sync_button" class="button">Sincronizar Ano e Períodos</a></p>
                <div style="margin: 10px 0;" id="sync_results"></div>
                
                <hr />

                <h2>Formulário de Contato</h2>
                <p>
                    <label>E-mail do <strong>Departamento Responsável</strong></label>
                    <br />
                    <input type="email" name="tools[contact_form_to_email]" value="<?= $tools['contact_form_to_email'] ?>" style="width: 30%;" />
                </p>
                <p>
                    <label>Assunto do Email</label>
                    <br />
                    <input type="text" name="tools[contact_form_subject]" value="<?= $tools['contact_form_subject'] ?>" style="width: 30%;" />
                </p>
                <p>
                    <label>Escolha uma <strong>página de resposta</strong> para este formulário</label>
                    <br />
                    <select name="tools[contact_form_page_to]">
                        <option value="">Selecione a página de resposta</option>
                        <?php
                            $args = array();
                            $pages = get_pages( $args );
                        ?>
                        <?php foreach( $pages as $page ): ?>
                            <option value="<?php echo $page->ID; ?>" <?php echo $tools['contact_form_page_to'] == $page->ID ? 'selected' : ''; ?>><?php echo $page->post_title; ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>
                <div class="card">
                    <h3 class="title">Shortcode para exibição do formulário</h3>
                    <p>[tools-contato]</p>
                </div>

                <?php submit_button(); ?>

                <hr >

                <h2>Matrícula</h2>
                <p>
                    <label>E-mail do <strong>Departamento Responsável</strong></label>
                    <br />
                    <input type="email" name="tools[enroll_to_email]" value="<?= $tools['enroll_to_email'] ?>" style="width: 30%;" />
                </p>
                <p>
                    <label>Assunto do Email</label>
                    <br />
                    <input type="text" name="tools[enroll_subject]" value="<?= $tools['enroll_subject'] ?>" style="width: 30%;" />
                </p>
                <p>
                    <label>Salvar em qual formulário?</label>
                    <br />
                    <select name="tools[enroll_form_cf7]">
                        <option value="">Selecione o nome do formulário</option>
                        <?php 
                            $params = array(
                                'post_type'           => 'wpcf7_contact_form',
                                'post_status'         => 'publish',
                                'posts_per_page'      => -1,
                                'orderby'			=> 'name',
                                'order'				=> 'ASC'
                            );
                            $cf7 = new WP_Query( $params );
                        ?>
                        <?php while( $cf7->have_posts() ): $cf7->the_post(); ?>
                            <option value="<?php echo get_the_ID(); ?>" <?php echo $tools['enroll_form_cf7'] == get_the_ID() ? 'selected' : ''; ?>><?php the_title(); ?></option>
                        <?php endwhile; wp_reset_query(); ?>
                    </select>
                </p>
                <p>
                    <label>Escolha uma <strong>página de resposta</strong> para este formulário</label>
                    <br />
                    <select name="tools[enroll_page_to]">
                        <option value="">Selecione a página de resposta</option>
                        <?php
                            $args = array();
                            $pages = get_pages( $args );
                        ?>
                        <?php foreach( $pages as $page ): ?>
                            <option value="<?php echo $page->ID; ?>" <?php echo $tools['enroll_page_to'] == $page->ID ? 'selected' : ''; ?>><?php echo $page->post_title; ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>
                <div class="card">
                    <h3 class="title">Shortcode para exibição do formulário</h3>
                    <p>[tools-matricula]</p>
                </div>

                <?php submit_button(); ?>

            </div>


        </div>
    
    </form>

