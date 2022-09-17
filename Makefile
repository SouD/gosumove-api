.PHONY: help ## Prints the help about targets.
help:
	@echo "Please use \`make <target>' where <target> is one of"
	@grep -E '^\.PHONY: [a-zA-Z_-]+ .*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = "(: |##)"}; {printf "\033[36m%-30s\033[0m %s\n", $$2, $$3}'

.PHONY: install-tools ## Install php tools
install-tools:
	cp tools/git-hooks/pre-commit .git/hooks/

.PHONY: lint ## shorthand composer php-cs-fixer
lint:
	composer php-cs-fixer
