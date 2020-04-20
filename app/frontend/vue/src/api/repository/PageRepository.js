export default class PageRepository {
    constructor(axios) {
        this.axios = axios;
    }

    async get(slug) {
        return await this.axios.get('/pages/' + slug);
    }
}

