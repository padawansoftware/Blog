'use strict';

import axios from "axios";

import CollectionRepository from '@repository/CollectionRepository.js';
import PostRepository from '@repository/PostRepository.js';
import PageRepository from '@repository/PageRepository.js';

const repositories = {
    collection: CollectionRepository,
    post: PostRepository,
    page: PageRepository
}

export default class Api {

    constructor() {
        this.axios = axios.create({ baseURL: process.env.API_URL })
        this.cache = [];
    }

    get(repositoryEntity) {
        if (! this.cache[repositoryEntity]) {
            var repository = repositories[repositoryEntity];

            if (! repository) {
                throw `The repository for "${repositoryEntity}" is not available`
            }

            this.cache[repositoryEntity] = new repository(this.axios);
        }

        return this.cache[repositoryEntity];
    }
}
