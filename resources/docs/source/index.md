---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://quiz-api.minjemin.com/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_31cd693e3bef8b56cb72c137e624646a -->
## api/quiz/{quiz}/submit
> Example request:

```bash
curl -X POST \
    "https://quiz-api.minjemin.com/api/quiz/1/submit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "https://quiz-api.minjemin.com/api/quiz/1/submit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "errors": [
        {
            "attribute": null,
            "message": [
                "Unauthenticated."
            ]
        }
    ],
    "meta": {
        "http_status": 401
    }
}
```

### HTTP Request
`POST api/quiz/{quiz}/submit`


<!-- END_31cd693e3bef8b56cb72c137e624646a -->

<!-- START_05b5083d6afc2f12aee74bbea0bcf315 -->
## api/quiz_public
> Example request:

```bash
curl -X GET \
    -G "https://quiz-api.minjemin.com/api/quiz_public" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "https://quiz-api.minjemin.com/api/quiz_public"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "errors": [
        {
            "attribute": null,
            "message": [
                "Unauthenticated."
            ]
        }
    ],
    "meta": {
        "http_status": 401
    }
}
```

### HTTP Request
`GET api/quiz_public`


<!-- END_05b5083d6afc2f12aee74bbea0bcf315 -->

<!-- START_847105ff05a18df490dac4564923ded8 -->
## api/quiz
> Example request:

```bash
curl -X GET \
    -G "https://quiz-api.minjemin.com/api/quiz" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "https://quiz-api.minjemin.com/api/quiz"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "errors": [
        {
            "attribute": null,
            "message": [
                "Unauthenticated."
            ]
        }
    ],
    "meta": {
        "http_status": 401
    }
}
```

### HTTP Request
`GET api/quiz`


<!-- END_847105ff05a18df490dac4564923ded8 -->

<!-- START_c2ecc0392eabd6728e103d7b25187b46 -->
## api/quiz
> Example request:

```bash
curl -X POST \
    "https://quiz-api.minjemin.com/api/quiz" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "https://quiz-api.minjemin.com/api/quiz"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "errors": [
        {
            "attribute": null,
            "message": [
                "Unauthenticated."
            ]
        }
    ],
    "meta": {
        "http_status": 401
    }
}
```

### HTTP Request
`POST api/quiz`


<!-- END_c2ecc0392eabd6728e103d7b25187b46 -->

<!-- START_8b261c07604a3a473665e7706c6be07e -->
## api/quiz/{quiz}
> Example request:

```bash
curl -X GET \
    -G "https://quiz-api.minjemin.com/api/quiz/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "https://quiz-api.minjemin.com/api/quiz/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "errors": [
        {
            "attribute": null,
            "message": [
                "Unauthenticated."
            ]
        }
    ],
    "meta": {
        "http_status": 401
    }
}
```

### HTTP Request
`GET api/quiz/{quiz}`


<!-- END_8b261c07604a3a473665e7706c6be07e -->

<!-- START_3428029e18c30e6718dd51618c5ac11f -->
## api/quiz/{quiz}/edit
> Example request:

```bash
curl -X GET \
    -G "https://quiz-api.minjemin.com/api/quiz/1/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "https://quiz-api.minjemin.com/api/quiz/1/edit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "errors": [
        {
            "attribute": null,
            "message": [
                "Unauthenticated."
            ]
        }
    ],
    "meta": {
        "http_status": 401
    }
}
```

### HTTP Request
`GET api/quiz/{quiz}/edit`


<!-- END_3428029e18c30e6718dd51618c5ac11f -->

<!-- START_cc587a0a2f7012d3ced3ebbebf69f398 -->
## api/quiz/{quiz}
> Example request:

```bash
curl -X PUT \
    "https://quiz-api.minjemin.com/api/quiz/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "https://quiz-api.minjemin.com/api/quiz/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "errors": [
        {
            "attribute": null,
            "message": [
                "Unauthenticated."
            ]
        }
    ],
    "meta": {
        "http_status": 401
    }
}
```

### HTTP Request
`PUT api/quiz/{quiz}`

`PATCH api/quiz/{quiz}`


<!-- END_cc587a0a2f7012d3ced3ebbebf69f398 -->

<!-- START_209c872562fd76b50349d1f0f9a95738 -->
## api/quiz/{quiz}
> Example request:

```bash
curl -X DELETE \
    "https://quiz-api.minjemin.com/api/quiz/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "https://quiz-api.minjemin.com/api/quiz/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "errors": [
        {
            "attribute": null,
            "message": [
                "Unauthenticated."
            ]
        }
    ],
    "meta": {
        "http_status": 401
    }
}
```

### HTTP Request
`DELETE api/quiz/{quiz}`


<!-- END_209c872562fd76b50349d1f0f9a95738 -->

<!-- START_109013899e0bc43247b0f00b67f889cf -->
## api/categories
> Example request:

```bash
curl -X GET \
    -G "https://quiz-api.minjemin.com/api/categories" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "https://quiz-api.minjemin.com/api/categories"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "errors": [
        {
            "attribute": null,
            "message": [
                "Unauthenticated."
            ]
        }
    ],
    "meta": {
        "http_status": 401
    }
}
```

### HTTP Request
`GET api/categories`


<!-- END_109013899e0bc43247b0f00b67f889cf -->

<!-- START_2574d2e46a2be2f31e933d51e1f19196 -->
## api/categories/{category}/quiz/private
> Example request:

```bash
curl -X GET \
    -G "https://quiz-api.minjemin.com/api/categories/1/quiz/private" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "https://quiz-api.minjemin.com/api/categories/1/quiz/private"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "errors": [
        {
            "attribute": null,
            "message": [
                "Unauthenticated."
            ]
        }
    ],
    "meta": {
        "http_status": 401
    }
}
```

### HTTP Request
`GET api/categories/{category}/quiz/private`


<!-- END_2574d2e46a2be2f31e933d51e1f19196 -->

<!-- START_bce2d202b95c6253a9646d0752b8e1ab -->
## api/categories/{category}/quiz/public
> Example request:

```bash
curl -X GET \
    -G "https://quiz-api.minjemin.com/api/categories/1/quiz/public" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "https://quiz-api.minjemin.com/api/categories/1/quiz/public"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "errors": [
        {
            "attribute": null,
            "message": [
                "Unauthenticated."
            ]
        }
    ],
    "meta": {
        "http_status": 401
    }
}
```

### HTTP Request
`GET api/categories/{category}/quiz/public`


<!-- END_bce2d202b95c6253a9646d0752b8e1ab -->

<!-- START_d292dec4a3d6b300cf5f12ac9276e645 -->
## api/intermezzo/{date}
> Example request:

```bash
curl -X GET \
    -G "https://quiz-api.minjemin.com/api/intermezzo/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "https://quiz-api.minjemin.com/api/intermezzo/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "errors": [
        {
            "attribute": null,
            "message": [
                "Unauthenticated."
            ]
        }
    ],
    "meta": {
        "http_status": 401
    }
}
```

### HTTP Request
`GET api/intermezzo/{date}`


<!-- END_d292dec4a3d6b300cf5f12ac9276e645 -->


