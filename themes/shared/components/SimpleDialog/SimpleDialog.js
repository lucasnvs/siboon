import {Component} from "../Component";

class SimpleDialog extends Component {
    constructor(parentId) {
        super(parentId);

        const dialog = document.createElement("dialog");
        
        this.body = "";
    }
}