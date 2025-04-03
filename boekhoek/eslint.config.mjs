import globals from "globals";
import pluginJs from "@eslint/js";
export default [
    { languageOptions: { globals: globals.node } },
    pluginJs.configs.recommended,
    {
        rules: {
            "no-undef": "warn",
            "max-len": ["error", { code: 120, ignoreComments: true }],
            "no-console": "off",
            "no-var": "off",
            "one-var": "off",
            "prefer-const": "off",
            "vars-on-top": "off",
            eqeqeq: "off",
            "no-else-return": "off",
            "eol-last": "off",
            indent: ["error", 4, { SwitchCase: 1 }],
            "no-multiple-empty-lines": "off",
            "no-plusplus": "off",
            "operator-linebreak": "off",
            "object-shorthand": "off",
            "dot-notation": "off",
            "no-prototype-builtins": "off",
            "array-element-newline": "off",
            "array-bracket-newline": "off",
            "arrow-parens": "off",
            "prefer-spread": "off",
            "function-paren-newline": "off",
            "func-names": "off",
            "prefer-arrow-callback": "off",
            "no-iterator": "off",
            "no-restricted-syntax": "off",
            "no-restricted-properties": "off",
            "no-use-before-define": "off",
            "switch-colon-spacing": "off",
            "prefer-destructuring": "off",
            quotes: "off",
            "prefer-template": "off",
            // Allow global vars to be unused as we can't properly check those
            "no-unused-vars": "warn",
            // To allow call backs to style elements
            "no-param-reassign": "off",
            "lines-between-class-members": "off",
            radix: "off",
            // We don't know enough in advance about how you'll be importing other code
            "import/extensions": "off",
            "no-alert": "off",
            // As we don't download the node_modules, resolution will always fail
            "import/no-unresolved": "off",
            "env": {
                "browser": true,
                "node": true,
            }
        },
    },
];
