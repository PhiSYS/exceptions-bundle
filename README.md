# DosFarma Exceptions Bundle
Symfony bundle for dosfarma/exceptions integration.

## ApiExceptionListener

By default, replace Symfony standard exception response by a JsonResponse, using the api exception status code for the http code.

**JsonResponse payload example**

```json
{
  "message": "An error has occurred",
  "error_code": 400123 
}
```

You can implement your own ApiResponseLoader with a different json structure, or even with a different Response implementation,
just by defining it with the service ID `"DosFarma\ExceptionsBundle\Http\Service\ApiResponseLoader"`.
