# Contributing to Lapong Docker

Thank you for your interest in contributing.

---

## Development Workflow

### 1. Fork and Clone

```bash
git clone https://github.com/YOUR_USERNAME/lapong-docker.git
cd lapong-docker
```

### 2. Create a Branch

```bash
git checkout -b feature/your-feature-name
```

### 3. Make Changes

- Keep changes focused and atomic
- Follow existing code style
- Test your changes locally

### 4. Test

```bash
make build && make up
curl http://localhost:8080/
make test
make down
```

### 5. Commit and Push

```bash
git add .
git commit -m "feat: add new feature"
git push origin feature/your-feature-name
```

---

## Security Guidelines

- **Never commit secrets** (passwords, API keys, tokens)
- Use `.env` files for sensitive configuration
- Verify `.gitignore` excludes sensitive files

---

## License

By contributing, you agree that your contributions will be licensed under the MIT License.