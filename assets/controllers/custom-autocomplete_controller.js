import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    initialize() {
        console.log('init');
        console.error('init');
        this._onPreConnect = this._onPreConnect.bind(this);
        this._onConnect = this._onConnect.bind(this);
    }

    connect() {
        console.log('init');
        this.element.addEventListener('autocomplete:pre-connect', this._onPreConnect);
        this.element.addEventListener('autocomplete:connect', this._onConnect);
    }

    disconnect() {
        console.log('init');
        // You should always remove listeners when the controller is disconnected to avoid side-effects
        this.element.removeEventListener('autocomplete:pre-connect', this._onConnect);
        this.element.removeEventListener('autocomplete:connect', this._onPreConnect);
    }

    _onPreConnect(event) {
        console.log('init');
        // TomSelect has not been initialized - options can be changed
        console.log(event.detail.options); // Options that will be used to initialize TomSelect
        // event.detail.options.onChange = (value) => {
        //     // ...
        // };
    }

    _onConnect(event) {
        console.log('init');
        // TomSelect has just been intialized and you can access details from the event
        console.log(event.detail.tomSelect); // TomSelect instance
        console.log(event.detail.options); // Options used to initialize TomSelect
    }
}
