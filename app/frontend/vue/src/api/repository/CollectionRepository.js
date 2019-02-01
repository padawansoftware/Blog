export default class CollectionRepository{
    constructor(api) {
        this.api = api;
    }

    async list() {
        return await this.api.get('/collections', {params: {view: 'list'}} );
    }

    async detail(id) {
        return await this.api.get(`/collections/${id}`, {params: {view: 'list'}} );
    }

    async posts(id) {
        return await this.api.get(`/collections/${id}/posts`, {params: {view: 'list'}});
    }
}

