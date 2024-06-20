export class Component {
    parentId;
    body;

    constructor(parentId, body) {
        this.parentId = parentId;
        this.body = body;
    }

    inflate()  {
        document.getElementById(this.parentId).appendChild(this.body);
    }
}