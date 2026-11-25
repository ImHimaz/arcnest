/**
 * Header (layout/header, on every page): starts smooth wheel scrolling for
 * the whole page (assets/utils/smooth-scroll.js).
 */
import { onReady } from '../../utils';
import { smoothScroll } from '../../utils/smooth-scroll';

onReady( smoothScroll );
