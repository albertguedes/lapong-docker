# Contributing to Lapong Docker

Thank you for your interest in contributing.

This project follows the [minimal_viable](https://github.com/albertguedes/minimal-viable-docker-development-environment) Docker stack patterns (host networking, Makefile, backup/CI). Laravel-specific changes belong in `src/`; infrastructure changes should stay aligned with that template where possible.

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
make test              # HTTP + full PHPUnit suite
make test-unit         # Unit tests only
make test-integration  # Integration tests only
make test-backup       # Backup scripts (modifies DB — use dev data only)
make down
```

Ensure no other stack is bound to ports **8080**, **9000**, or **5432** on the host.

### 5. Commit and Push

```bash
git add .
git commit -m "feat: add new feature"
git push origin feature/your-feature-name
```

---

## Security Guidelines

- **Never commit secrets** (passwords, API keys, tokens)
- Use `.env` and `src/.env` for sensitive configuration (both gitignored)
- Verify `.gitignore` excludes sensitive files
- Use `backup/config.local.sh` for backup provider credentials (gitignored)

---

## License

By contributing, you agree that your contributions will be licensed under the MIT License.
