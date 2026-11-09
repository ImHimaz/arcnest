<?php
/**
 * Title: Contact
 * Slug: wp-elite/section-contact
 * Categories: wp-elite, call-to-action
 * Keywords: contact, form, project, enquiry, call to action
 * Description: "Have a project in mind?" on purple: the heading, a line, the contact form (the Elite Form "Contact": run `wp arcnest contact-form` to create it), a note and the founding clients box. Section class elite-section--contact, ID contact.
 *
 * @package WpElite
 */

// The Elite Form named "contact" (slug), if this site has it; otherwise the
// block asks for a form in the editor.
$wp_elite_form = class_exists( '\EliteBlocks\Forms' ) ? get_page_by_path( 'contact', OBJECT, \EliteBlocks\Forms::POST_TYPE ) : null;
$wp_elite_form = array(
	'form'      => $wp_elite_form ? $wp_elite_form->ID : 0,
	'className' => 'elite-form--contact-form',
);
?>
<!-- wp:elite/section {"label":"Contact","anchor":"contact","className":"elite-section--contact"} -->
<section class="elite-section alignfull elite-section--contact" id="contact"><div class="section-inner"><div class="container"><!-- wp:elite/paragraph {"textStyle":"eyebrow","className":"elite-paragraph--eyebrow"} -->
<p class="elite-paragraph elite-paragraph--eyebrow" style="font-family:var(--text-eyebrow-font-family);font-size:var(--text-eyebrow-font-size);font-weight:var(--text-eyebrow-font-weight);line-height:var(--text-eyebrow-line-height);letter-spacing:var(--text-eyebrow-letter-spacing);text-transform:var(--text-eyebrow-text-transform)"><?php esc_html_e( 'Start a project', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/heading {"textStyle":"title-2"} -->
<h2 class="elite-heading" style="font-family:var(--text-title-2-font-family);font-size:var(--text-title-2-font-size);font-weight:var(--text-title-2-font-weight);line-height:var(--text-title-2-line-height);letter-spacing:var(--text-title-2-letter-spacing);text-transform:var(--text-title-2-text-transform)"><?php esc_html_e( 'Have a project in mind', 'wp-elite' ); ?><span class="elite-span elite-span--dot">?</span></h2>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"textStyle":"lead","className":"elite-paragraph--contact-lead"} -->
<p class="elite-paragraph elite-paragraph--contact-lead" style="font-family:var(--text-lead-font-family);font-size:var(--text-lead-font-size);font-weight:var(--text-lead-font-weight);line-height:var(--text-lead-line-height);letter-spacing:var(--text-lead-letter-spacing);text-transform:var(--text-lead-text-transform)"><?php esc_html_e( 'Tell us a little about your project. We’ll reply within one working day with next steps.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/form <?php echo wp_json_encode( $wp_elite_form ); ?> /-->

<!-- wp:elite/paragraph {"className":"elite-paragraph--contact-note"} -->
<p class="elite-paragraph elite-paragraph--contact-note"><?php esc_html_e( 'No obligation. We reply within one working day.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/div {"className":"elite-div--contact-founding"} -->
<div class="elite-div elite-div--contact-founding"><div class="div-inner"><!-- wp:elite/paragraph {"className":"elite-paragraph--contact-badge"} -->
<p class="elite-paragraph elite-paragraph--contact-badge"><?php esc_html_e( 'Now open', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph -->

<!-- wp:elite/div -->
<div class="elite-div"><div class="div-inner"><!-- wp:elite/heading {"level":3,"className":"elite-heading--contact-founding-title"} -->
<h3 class="elite-heading elite-heading--contact-founding-title"><?php esc_html_e( 'Founding client spots', 'wp-elite' ); ?></h3>
<!-- /wp:elite/heading -->

<!-- wp:elite/paragraph {"className":"elite-paragraph--contact-founding-text"} -->
<p class="elite-paragraph elite-paragraph--contact-founding-text"><?php esc_html_e( 'Arcnest is a new studio, but our team already builds WordPress sites for US companies. We’re taking on a small number of founding clients, with our full attention and special terms, in exchange for a case study and honest feedback.', 'wp-elite' ); ?></p>
<!-- /wp:elite/paragraph --></div></div>
<!-- /wp:elite/div --></div></div>
<!-- /wp:elite/div --></div></div></section>
<!-- /wp:elite/section -->
