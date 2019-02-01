'use strict';

import axios from "axios";

import CollectionRepository from '@repository/CollectionRepository.js';
import PostRepository from '@repository/PostRepository.js';

const repositories = {
    collection: CollectionRepository,
    post: PostRepository
}

export default class Api {

    constructor() {
        this.axios = axios.create({ baseURL: process.env.API_URL })
    }

    get(repositoryEntity) {
        var repository = repositories[repositoryEntity];

        if (! repository) {
            throw `The repository for "${repositoryEntity}" is not available`
        }

        return new repository(this.axios);
    }
}