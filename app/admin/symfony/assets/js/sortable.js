'use strict';

import Sortable from 'sortablejs/modular/sortable.core.esm.js';
import '../css/sortable.css';

export default function(element, options) {
    Sortable.create(element, options);
}
