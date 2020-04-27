export default class CollectionRepository {
    constructor(axios) {
        this.axios = axios;
    }

    async list() {
        return await this.axios.get('/collections', {params: {view: 'list'}} );
    }

    async detail(id) {
        return await this.axios.get(`/collections/${id}`, {params: {view: 'list'}} );
    }

    async posts(id) {
        return await this.axios.get(`/collections/${id}/posts`, {params: {view: 'list'}});
    }
}

