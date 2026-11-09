<?php
/**
 * What PHPStan needs to know of the plugins and WP-CLI the theme talks to
 * (scanned only, never loaded): the parts inc/integrations uses.
 *
 * @package WpElite
 */

// phpcs:disable

namespace EliteBlocks {
	class Forms {
		public const POST_TYPE = 'elite_form';
		public const META      = 'elite_form';
	}
}

namespace {
	class WPCF7_ContactForm {
		/** @param array<string, mixed>|string $options */
		public static function get_template( $options = '' ): self {
			return new self();
		}

		/** @return mixed */
		public function prop( string $name ) {
			return array();
		}

		/** @param array<string, mixed> $properties */
		public function set_properties( array $properties ): void {}

		public function save(): int {
			return 0;
		}
	}

	function wpcf7_contact_form( int $id ): ?WPCF7_ContactForm {
		return null;
	}

	function wpcf7_enqueue_scripts(): void {}

	class WP_CLI {
		/** @param string|\WP_Error $message */
		public static function error( $message ): void {}

		public static function success( string $message ): void {}

		public static function add_command( string $name, callable $callable ): void {}
	}
}
