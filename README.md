# Octane Streaming Bug Report
This repo is a minimal reproduction of a bug I'm seeing when streaming [OpenAI PHP Client](https://github.com/openai-php/client) responses while running [Laravel Octane](https://laravel.com/docs/10.x/octane).

## Reproduction Steps

1. Install dependencies
```bash
composer install
```

2. Start the octane server
```bash
artisan octane:start --server=frankenphp
```

3. Visit the chat page
```bash
http://127.0.0.1:8000/chat
```

4. See the error
```bash
Connection refused for URI https://api.openai.com/v1/chat/completions
```

5. Now start FrankenPHP without Octane
```bash
docker run -p 8000:443 -v $PWD:/app dunglas/frankenphp
```

6. Visit the chat page again to see it working correctly
```bash
https://localhost:8000/chat
```
