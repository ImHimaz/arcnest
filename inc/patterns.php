<?php
/**
 * Block markup helpers for this site's page patterns (the service pages):
 * each prints a block's comment and saved HTML exactly as the editor saves
 * it, so pages built from the patterns open without "invalid block"
 * warnings. Section helpers (service_hero(), included(), standards()…)
 * print whole sections from plain arrays of text.
 *
 * Only used while a pattern file renders (patterns/page-*.php).
 *
 * @package WpElite
 */

declare( strict_types = 1 );

namespace WpElite\Patterns;

/**
 * Block attributes as JSON for a block comment.
 *
 * @param array<string, mixed> $attributes Attributes.
 */
function json( array $attributes ): string {
	return (string) wp_json_encode( $attributes, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP );
}

/**
 * A block comment's attributes, with a leading space ('' when none).
 *
 * @param array<string, mixed> $attributes Attributes.
 */
function attrs( array $attributes ): string {
	return $attributes ? ' ' . json( $attributes ) : '';
}

/**
 * The inline style an Elite text style writes.
 *
 * @param string $style Text style slug.
 */
function text_style( string $style ): string {
	$parts = array();
	foreach ( array( 'font-family', 'font-size', 'font-weight', 'line-height', 'letter-spacing', 'text-transform' ) as $prop ) {
		$parts[] = "{$prop}:var(--text-{$style}-{$prop})";
	}
	return implode( ';', $parts );
}

/**
 * Allowed inline HTML in headings and paragraphs.
 *
 * @param string $html Text with inline HTML.
 */
function inline( string $html ): string {
	return wp_kses(
		$html,
		array(
			'a'      => array(
				'href'   => true,
				'target' => true,
				'rel'    => true,
			),
			'strong' => array(),
			'em'     => array(),
			'br'     => array(),
			'span'   => array( 'class' => true ),
		)
	);
}

/**
 * An Elite Heading.
 *
 * @param int    $level Level (1–6).
 * @param string $style Text style ('' for none).
 * @param string $html  Text (inline HTML allowed).
 * @param string $css Block class.
 */
function heading( int $level, string $style, string $html, string $css = '' ): void {
	$a = array_filter(
		array(
			'level'     => 2 === $level ? null : $level,
			'textStyle' => $style ? $style : null,
			'className' => $css ? $css : null,
		)
	);
	printf(
		"<!-- wp:elite/heading%1\$s -->\n<h%2\$d class=\"%3\$s\"%4\$s>%5\$s</h%2\$d>\n<!-- /wp:elite/heading -->\n\n",
		attrs( $a ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- JSON for a block comment.
		(int) $level,
		esc_attr( trim( 'elite-heading ' . $css ) ),
		$style ? ' style="' . esc_attr( text_style( $style ) ) . '"' : '',
		inline( $html ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Filtered by wp_kses.
	);
}

/**
 * An Elite Paragraph.
 *
 * @param string $html  Text (inline HTML allowed).
 * @param string $css Block class.
 * @param string $style Text style ('' for none).
 */
function para( string $html, string $css = '', string $style = '' ): void {
	$a = array_filter(
		array(
			'textStyle' => $style ? $style : null,
			'className' => $css ? $css : null,
		)
	);
	printf(
		"<!-- wp:elite/paragraph%1\$s -->\n<p class=\"%2\$s\"%3\$s>%4\$s</p>\n<!-- /wp:elite/paragraph -->\n\n",
		attrs( $a ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- JSON for a block comment.
		esc_attr( trim( 'elite-paragraph ' . $css ) ),
		$style ? ' style="' . esc_attr( text_style( $style ) ) . '"' : '',
		inline( $html ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Filtered by wp_kses.
	);
}

/**
 * The eyebrow above a section heading.
 *
 * @param string $text Text.
 */
function eyebrow( string $text ): void {
	para( esc_html( $text ), 'elite-paragraph--eyebrow', 'eyebrow' );
}

/**
 * A heading with the lime full stop (or question mark) after it.
 *
 * @param string $text  Heading text (plain).
 * @param string $style Text style.
 * @param string $css Block class.
 * @param string $mark  The mark after it.
 */
function title( string $text, string $style = 'title-2', string $css = '', string $mark = '.' ): void {
	heading( 2, $style, esc_html( $text ) . '<span class="elite-span elite-span--dot">' . esc_html( $mark ) . '</span>', $css );
}

/**
 * An Elite Button.
 *
 * @param string $text  Text.
 * @param string $url   Link.
 * @param string $css Block class (elite-button--primary, --secondary…).
 * @param string $icon  Icon after the text ('' for none).
 * @param bool   $tab   Opens in a new tab.
 */
function button( string $text, string $url, string $css, string $icon = '', bool $tab = false ): void {
	$link = array( 'url' => $url );
	if ( $tab ) {
		$link['opensInNewTab'] = true;
	}
	$a = array(
		'text' => $text,
		'link' => $link,
	);
	if ( $icon ) {
		$a['iconEnd'] = $icon;
	}
	$a['className'] = $css;
	echo '<!-- wp:elite/button ' . json( $a ) . " /-->\n\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- JSON for a block comment.
}

/**
 * An Elite Icon from the theme's set.
 *
 * @param string $name Icon name (assets/icons).
 * @param int    $size Size in px.
 */
function icon( string $name, int $size = 26 ): void {
	$a = array(
		'icon' => $name,
		'size' => array( 'desktop' => $size ),
	);
	echo '<!-- wp:elite/icon ' . json( $a ) . " /-->\n\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- JSON for a block comment.
}

/**
 * Open an Elite Div.
 *
 * @param string $css Block class.
 */
function div_open( string $css = '' ): void {
	printf(
		"<!-- wp:elite/div%1\$s -->\n<div class=\"%2\$s\"><div class=\"div-inner\">",
		attrs( $css ? array( 'className' => $css ) : array() ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- JSON for a block comment.
		esc_attr( trim( 'elite-div ' . $css ) )
	);
}

/**
 * Close an Elite Div.
 */
function div_close(): void {
	echo "</div></div>\n<!-- /wp:elite/div -->\n\n";
}

/**
 * Open an Elite Section (and its container).
 *
 * @param string $label  Label in the editor.
 * @param string $css  Section class.
 * @param string $anchor ID ('' for none).
 */
function section_open( string $label, string $css, string $anchor = '' ): void {
	$a = array( 'label' => $label );
	if ( $anchor ) {
		$a['anchor'] = $anchor;
	}
	$a['className'] = $css;
	printf(
		"<!-- wp:elite/section %1\$s -->\n<section class=\"elite-section alignfull %2\$s\"%3\$s><div class=\"section-inner\"><div class=\"container\">",
		json( $a ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- JSON for a block comment.
		esc_attr( $css ),
		$anchor ? ' id="' . esc_attr( $anchor ) . '"' : ''
	);
}

/**
 * Close an Elite Section.
 */
function section_close(): void {
	echo "</div></div></section>\n<!-- /wp:elite/section -->\n\n";
}

/**
 * Open an Elite Row.
 *
 * @param string $css Block class.
 */
function row_open( string $css = '' ): void {
	printf(
		"<!-- wp:elite/row%1\$s -->\n<div class=\"%2\$s\">",
		attrs( $css ? array( 'className' => $css ) : array() ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- JSON for a block comment.
		esc_attr( trim( 'elite-row row ' . $css ) )
	);
}

/**
 * Close an Elite Row.
 */
function row_close(): void {
	echo "</div>\n<!-- /wp:elite/row -->\n\n";
}

/**
 * Open an Elite Column.
 *
 * @param array<string, array{width?: int, offset?: int}> $size  Per device (mobile, tablet, laptop, desktop).
 * @param string                                          $css Block class.
 */
function col_open( array $size, string $css = '' ): void {
	$classes = array( 'elite-column' );
	foreach ( array(
		'mobile'  => '',
		'tablet'  => '-md',
		'laptop'  => '-lg',
		'desktop' => '-xl',
	) as $device => $infix ) {
		if ( isset( $size[ $device ]['width'] ) ) {
			$classes[] = "col{$infix}-" . (int) $size[ $device ]['width'];
		}
		if ( isset( $size[ $device ]['offset'] ) ) {
			$classes[] = "offset{$infix}-" . (int) $size[ $device ]['offset'];
		}
	}
	if ( $css ) {
		$classes[] = $css;
	}
	$a = array( 'size' => $size );
	if ( $css ) {
		$a['className'] = $css;
	}
	printf(
		"<!-- wp:elite/column %1\$s -->\n<div class=\"%2\$s\"><div class=\"column-inner\">",
		json( $a ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- JSON for a block comment.
		esc_attr( implode( ' ', $classes ) )
	);
}

/**
 * Close an Elite Column.
 */
function col_close(): void {
	echo "</div></div>\n<!-- /wp:elite/column -->\n\n";
}

/**
 * A core List.
 *
 * @param string   $css Block class.
 * @param string[] $items Items (inline HTML allowed).
 */
function items( string $css, array $items ): void {
	$lis = array();
	foreach ( $items as $item ) {
		$lis[] = "<!-- wp:list-item -->\n<li>" . inline( $item ) . "</li>\n<!-- /wp:list-item -->";
	}
	printf(
		"<!-- wp:list {\"className\":\"%1\$s\"} -->\n<ul class=\"wp-block-list %1\$s\">%2\$s</ul>\n<!-- /wp:list -->\n\n",
		esc_attr( $css ),
		implode( "\n\n", $lis ) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Filtered by wp_kses above.
	);
}

/**
 * The heading row of a section: eyebrow and heading on the left, a line on
 * the right (laptops), bottoms aligned.
 *
 * @param string $eyebrow Eyebrow.
 * @param string $title   Heading.
 * @param string $lead    Line ('' for none).
 */
function head_split( string $eyebrow, string $title, string $lead = '' ): void {
	row_open( 'elite-row--service-head' );
	col_open(
		array(
			'mobile' => array( 'width' => 12 ),
			'laptop' => array( 'width' => 7 ),
		)
	);
	eyebrow( $eyebrow );
	title( $title );
	col_close();
	if ( $lead ) {
		col_open(
			array(
				'mobile' => array( 'width' => 12 ),
				'laptop' => array(
					'width'  => 4,
					'offset' => 1,
				),
			)
		);
		para( esc_html( $lead ), 'elite-paragraph--service-lead', 'lead' );
		col_close();
	}
	row_close();
}

// -------------------------------------------------------------------------
// Sections
// -------------------------------------------------------------------------

/**
 * The page's hero: crumbs, eyebrow, heading (part highlighted), lead, two
 * buttons, and a card beside it (rows with an icon or a short tag).
 *
 * @param array{crumb: string, eyebrow: string, title: string, highlight: string, lead: string, buttons: list<array{0: string, 1: string, 2: string, 3?: string}>, card: string, dark?: bool, top?: bool, rows: list<array{0: string, 1: string, 2: string, 3?: bool}>} $a Hero.
 *        Buttons: text, link, class, icon. Rows: icon name (or tag text when 4th is true), title, line.
 *        Top: a top-level page (crumbs Home / This page).
 */
function service_hero( array $a ): void {
	section_open( __( 'Service hero', 'wp-elite' ), 'elite-section--service-hero' );
	row_open( 'elite-row--service-hero' );
	col_open(
		array(
			'mobile' => array( 'width' => 12 ),
			'laptop' => array( 'width' => 7 ),
		)
	);
	para(
		sprintf(
			'<a href="%1$s">%2$s</a> <span class="elite-span elite-span--crumb">/</span> %3$s%4$s',
			esc_url( home_url( '/' ) ),
			esc_html__( 'Home', 'wp-elite' ),
			// Service pages: Home / Services / This page.
			empty( $a['top'] ) ? sprintf( '<a href="%1$s">%2$s</a> <span class="elite-span elite-span--crumb">/</span> ', esc_url( home_url( '/#services' ) ), esc_html__( 'Services', 'wp-elite' ) ) : '',
			esc_html( $a['crumb'] )
		),
		'elite-paragraph--service-crumbs'
	);
	eyebrow( $a['eyebrow'] );
	heading( 1, 'title-1', esc_html( $a['title'] ) . ' <span class="elite-span elite-span--highlight">' . esc_html( $a['highlight'] ) . '</span>' );
	para( esc_html( $a['lead'] ), 'elite-paragraph--service-hero-lead', 'lead' );
	div_open( 'elite-div--service-actions' );
	foreach ( $a['buttons'] as $b ) {
		button( $b[0], $b[1], $b[2], $b[3] ?? '' );
	}
	div_close();
	col_close();
	col_open(
		array(
			'mobile' => array( 'width' => 12 ),
			'laptop' => array( 'width' => 5 ),
		)
	);
	div_open( empty( $a['dark'] ) ? 'elite-div--service-card' : 'elite-div--service-card elite-div--service-card-dark' );
	para( esc_html( $a['card'] ), 'elite-paragraph--service-card-label' );
	foreach ( $a['rows'] as $r ) {
		div_open( 'elite-div--service-card-row' );
		if ( ! empty( $r[3] ) ) {
			para( esc_html( $r[0] ), 'elite-paragraph--service-card-tag' );
		} else {
			icon( $r[0], 22 );
		}
		div_open();
		para( esc_html( $r[1] ), 'elite-paragraph--service-card-title' );
		para( esc_html( $r[2] ) );
		div_close();
		div_close();
	}
	div_close();
	col_close();
	row_close();
	section_close();
}

/**
 * "Who it's for": eyebrow, heading and three numbered cards. With a line,
 * the heading row has it on the right (laptops), as the other sections do
 * (the speed test's "Why it's faster").
 *
 * @param string                            $eyebrow Eyebrow.
 * @param string                            $title   Heading.
 * @param list<array{0: string, 1: string}> $cards   Title, line.
 * @param string                            $lead    Line, or empty for none.
 * @param string                            $anchor  Section ID, or empty for none.
 * @param string                            $label   Section label in the editor, or empty for the default.
 */
function fit( string $eyebrow, string $title, array $cards, string $lead = '', string $anchor = '', string $label = '' ): void {
	section_open( $label ? $label : __( 'Who it’s for', 'wp-elite' ), 'elite-section--service-fit', $anchor );
	if ( $lead ) {
		head_split( $eyebrow, $title, $lead );
	} else {
		div_open( 'elite-div--service-fit-head' );
		eyebrow( $eyebrow );
		title( $title );
		div_close();
	}
	div_open( 'elite-div--service-fit-grid' );
	foreach ( $cards as $i => $c ) {
		div_open( 'elite-div--service-fit' );
		para( sprintf( '%02d', $i + 1 ), 'elite-paragraph--service-fit-num' );
		heading( 3, 'title-4', esc_html( $c[0] ) );
		para( esc_html( $c[1] ) );
		div_close();
	}
	div_close();
	section_close();
}

/**
 * "Signs it's time": eyebrow, heading and warning cards, two by two.
 *
 * @param string                            $eyebrow Eyebrow.
 * @param string                            $title   Heading.
 * @param list<array{0: string, 1: string}> $cards   Title, line.
 */
function signs( string $eyebrow, string $title, array $cards ): void {
	section_open( __( 'Signs it’s time', 'wp-elite' ), 'elite-section--service-fit' );
	div_open( 'elite-div--service-fit-head' );
	eyebrow( $eyebrow );
	title( $title );
	div_close();
	div_open( 'elite-div--service-signs' );
	foreach ( $cards as $c ) {
		div_open( 'elite-div--service-sign' );
		heading( 3, 'title-5', esc_html( $c[0] ) );
		para( esc_html( $c[1] ) );
		div_close();
	}
	div_close();
	section_close();
}

/**
 * "What's included": a heading row and a 3 × 3 grid (icon, title, line).
 *
 * @param string                                       $eyebrow Eyebrow.
 * @param string                                       $title   Heading.
 * @param string                                       $lead    Line.
 * @param list<array{0: string, 1: string, 2: string}> $cells   Icon, title, line.
 */
function included( string $eyebrow, string $title, string $lead, array $cells ): void {
	section_open( __( 'What’s included', 'wp-elite' ), 'elite-section--service-included' );
	head_split( $eyebrow, $title, $lead );
	div_open( 'elite-div--service-included' );
	foreach ( $cells as $c ) {
		div_open( 'elite-div--service-item' );
		icon( $c[0], 28 );
		heading( 3, 'title-5', esc_html( $c[1] ) );
		para( esc_html( $c[2] ) );
		div_close();
	}
	div_close();
	section_close();
}

/**
 * How it works: the home page's Process section (its classes and styles)
 * with this page's steps, each with an optional time label.
 *
 * @param string                                        $eyebrow Eyebrow.
 * @param string                                        $title   Heading.
 * @param string                                        $lead    Line.
 * @param list<array{0: string, 1: string, 2?: string}> $steps   Title, line, time ('' for none).
 */
function steps( string $eyebrow, string $title, string $lead, array $steps ): void {
	section_open( __( 'How it works', 'wp-elite' ), 'elite-section--process', 'process' );
	div_open( 'elite-div--process-head' );
	eyebrow( $eyebrow );
	title( $title );
	para( esc_html( $lead ), 'elite-paragraph--process-lead', 'lead' );
	div_close();
	div_open( 'elite-div--process-steps' );
	foreach ( $steps as $i => $s ) {
		div_open( 'elite-div--process-step' );
		para( sprintf( '%02d', $i + 1 ), 'elite-paragraph--process-num' );
		if ( ! empty( $s[2] ) ) {
			para( esc_html( $s[2] ), 'elite-paragraph--process-when' );
		}
		heading( 3, 'title-4', esc_html( $s[0] ) );
		para( esc_html( $s[1] ) );
		div_close();
	}
	div_close();
	section_close();
}

/**
 * A purple band: eyebrow, heading and a line on the left, ticked items
 * (title and a small line) two across on the right.
 *
 * @param string                            $label   Section label.
 * @param string                            $eyebrow Eyebrow.
 * @param string                            $title   Heading.
 * @param string                            $sub     Line.
 * @param list<array{0: string, 1: string}> $items   Title, small line.
 */
function standards( string $label, string $eyebrow, string $title, string $sub, array $items ): void {
	section_open( $label, 'elite-section--service-standards' );
	row_open( 'elite-row--service-standards' );
	col_open(
		array(
			'mobile' => array( 'width' => 12 ),
			'laptop' => array( 'width' => 5 ),
		)
	);
	eyebrow( $eyebrow );
	title( $title );
	para( esc_html( $sub ), 'elite-paragraph--service-standards-sub', 'lead' );
	col_close();
	col_open(
		array(
			'mobile' => array( 'width' => 12 ),
			'laptop' => array( 'width' => 7 ),
		)
	);
	div_open( 'elite-div--service-standards' );
	foreach ( $items as $item ) {
		div_open( 'elite-div--service-standard' );
		para( '<strong>' . esc_html( $item[0] ) . '</strong> ' . esc_html( $item[1] ) );
		div_close();
	}
	div_close();
	col_close();
	row_close();
	section_close();
}

/**
 * Care plan tiers (no prices): a centred head, three cards (name, who it's
 * for, a checklist, a button; one featured) and a note.
 *
 * @param string                                                       $eyebrow Eyebrow.
 * @param string                                                       $title   Heading.
 * @param string                                                       $lead    Line.
 * @param list<array{0: string, 1: string, 2: list<string>, 3?: bool}> $plans   Name, for, items, featured.
 * @param string                                                       $note    Note under the cards.
 */
function plans( string $eyebrow, string $title, string $lead, array $plans, string $note ): void {
	section_open( __( 'Plans', 'wp-elite' ), 'elite-section--service-plans', 'plans' );
	div_open( 'elite-div--service-plans-head' );
	eyebrow( $eyebrow );
	title( $title );
	para( esc_html( $lead ), 'elite-paragraph--service-lead', 'lead' );
	div_close();
	div_open( 'elite-div--service-plans' );
	foreach ( $plans as $p ) {
		$featured = ! empty( $p[3] );
		div_open( $featured ? 'elite-div--service-plan elite-div--service-plan-featured' : 'elite-div--service-plan' );
		if ( $featured ) {
			para( esc_html__( 'Most chosen', 'wp-elite' ), 'elite-paragraph--service-plan-flag' );
		}
		heading( 3, 'title-3', esc_html( $p[0] ) );
		para( esc_html( $p[1] ), 'elite-paragraph--service-plan-for' );
		items( 'core-list--service-checks', array_map( 'esc_html', $p[2] ) );
		/* translators: %s: plan name. */
		button( sprintf( __( 'Ask about %s', 'wp-elite' ), $p[0] ), '/contact/?service=care-plans', $featured ? 'elite-button--primary' : 'elite-button--outline' );
		div_close();
	}
	div_close();
	para( esc_html( $note ), 'elite-paragraph--service-plans-note' );
	section_close();
}

/**
 * "Other services": links to the three other service pages (all four when
 * $current isn't one).
 *
 * @param string $current This page's slug.
 * @param string $eyebrow Eyebrow ('' for "Other services").
 */
function related( string $current, string $eyebrow = '' ): void {
	$all = array(
		'design-and-build' => __( 'Design & build', 'wp-elite' ),
		'rebuild'          => __( 'Rebuild without a page builder', 'wp-elite' ),
		'care-plans'       => __( 'Care plans', 'wp-elite' ),
		'white-label'      => __( 'White-label development', 'wp-elite' ),
	);
	section_open( __( 'Other services', 'wp-elite' ), 'elite-section--service-related' );
	eyebrow( $eyebrow ? $eyebrow : __( 'Other services', 'wp-elite' ) );
	div_open( 'elite-div--service-related' );
	foreach ( $all as $slug => $name ) {
		if ( $slug !== $current ) {
			button( $name, '/' . $slug . '/', 'elite-button--service-related', 'arrow-right' );
		}
	}
	div_close();
	section_close();
}

/**
 * Questions: the home page's FAQ section (its classes and styles) with this
 * page's questions; the first is open.
 *
 * @param list<array{0: string, 1: string}> $questions Question, answer.
 */
function faq( array $questions ): void {
	section_open( __( 'FAQ', 'wp-elite' ), 'elite-section--faq', 'faq' );
	row_open();
	col_open(
		array(
			'mobile' => array( 'width' => 12 ),
			'laptop' => array( 'width' => 4 ),
		)
	);
	eyebrow( __( 'FAQ', 'wp-elite' ) );
	title( __( 'Questions', 'wp-elite' ) );
	para( esc_html__( 'Something else? Email', 'wp-elite' ) . ' <a href="mailto:hello@arcnest.dev">hello@arcnest.dev</a>', 'elite-paragraph--faq-note' );
	col_close();
	col_open(
		array(
			'mobile' => array( 'width' => 12 ),
			'laptop' => array(
				'width'  => 7,
				'offset' => 1,
			),
		),
		'elite-column--faq-list'
	);
	echo '<!-- wp:elite/accordion {"start":"first","indicator":"plus","faqSchema":true,"className":"elite-accordion--faq-list"} -->' . "\n";
	foreach ( $questions as $q ) {
		echo '<!-- wp:elite/accordion-item ' . json( array( 'title' => $q[0] ) ) . " -->\n<!-- wp:elite/accordion-body -->\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- JSON for a block comment.
		para( esc_html( $q[1] ) );
		echo "<!-- /wp:elite/accordion-body -->\n<!-- /wp:elite/accordion-item -->\n";
	}
	echo '<!-- /wp:elite/accordion -->';
	col_close();
	row_close();
	section_close();
}

/**
 * The closing band: the home page's Call to action section (its classes
 * and styles) with this page's words.
 *
 * @param string                                       $title   Heading start.
 * @param string                                       $lime    Heading end, in lime.
 * @param string                                       $lead    Line.
 * @param list<array{0: string, 1: string, 2: string}> $buttons Text, link, class.
 */
function cta( string $title, string $lime, string $lead, array $buttons ): void {
	section_open( __( 'Call to action', 'wp-elite' ), 'elite-section--cta' );
	heading( 2, 'title-1', esc_html( $title ) . ' <span class="elite-span elite-span--lime">' . esc_html( $lime ) . '</span>', 'elite-heading--cta-title' );
	para( esc_html( $lead ), 'elite-paragraph--cta-lead', 'lead' );
	div_open( 'elite-div--cta-actions' );
	foreach ( $buttons as $i => $b ) {
		button( $b[0], $b[1], $b[2], 0 === $i ? 'arrow-right' : '' );
	}
	div_close();
	section_close();
}
