## Datasource

- For reviews or products data, you can use what's available in the `database` folder.

#### Example :

```bash
$ php application review:summary
{
  "total_reviews": 500,
  "average_ratings": 2.9,
  "5_star": 62,
  "4_star": 117,
  "3_star": 126,
  "2_star": 123,
  "1_star": 72
}
```

```bash
$ php application review:product 1
{
    "total_reviews": 100,
    "average_ratings": 4.9,
    "5_star": 40,
    "4_star": 34,
    "3_star": 16,
    "2_star": 13,
    "1_star": 7
}
```

## Testing

You can run predefined testcase we provide by running :

```bash
$ ./vendor/bin/phpunit tests
```
