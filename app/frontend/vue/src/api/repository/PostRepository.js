var qs = require('qs');

export default class PostRepository {
    constructor(api) {
        this.api = api;
    }

    /**
     * Retrieve all posts for listing.
     */
    async list() {
        return await this.api.get(
            '/posts',
            {
                params: { view: 'list' }
            }
         );
    }

    /**
     * Retrieve a list of posts for summary
     *
     * @param number The number of post to retrieve for summary
     */
    async summary(number) {
        return await this.api.get('/posts/', {
            params: {
                view: 'summary',
                limit: number,
                order: {
                    order: 'DESC'
                }
            },
            paramsSerializer: function(params) {
                return qs.stringify(params);
            }
        });
    }

    /**
     * Retrieve a post in detail
     *
     * @param slug The slug that identifies the post
     */
    async detail(slug) {
        return await this.api.get('/posts/' + slug, {
            params: {
                view: 'detail'
            }
        });
    }

    /**
     * Retrieve a preview of post in detail
     *
     * @param slug The slug that identifies the post
     * @param preview The preview hash
     */
    async preview(slug, preview) {
        return await this.api.get('/posts/' + slug, {params: {view: 'detail', preview}})
    }
}
