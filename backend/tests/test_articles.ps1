# Base URL
$BASE_URL = "http://localhost:8000/api"

Write-Host "Testing Article CRUD Operations"
Write-Host "==============================="

# 1. Create a new article
Write-Host "`n1. Creating a new article..."
$createBody = @{
    title = "Test Article"
    body = "This is a test article content"
    contributor_username = "test_user"
    start_date = "2024-03-29"
    end_date = "2024-04-29"
} | ConvertTo-Json

$createResponse = Invoke-RestMethod -Uri "$BASE_URL/articles" -Method Post -Body $createBody -ContentType "application/json"
Write-Host "Create Response:"
$createResponse | ConvertTo-Json

# Get the article ID from the response
$articleId = $createResponse.article_id

# 2. Get all articles
Write-Host "`n2. Getting all articles..."
$allArticles = Invoke-RestMethod -Uri "$BASE_URL/articles" -Method Get
$allArticles | ConvertTo-Json

# 3. Get single article
Write-Host "`n3. Getting single article (ID: $articleId)..."
$singleArticle = Invoke-RestMethod -Uri "$BASE_URL/articles/$articleId" -Method Get
$singleArticle | ConvertTo-Json

# 4. Update article
Write-Host "`n4. Updating article (ID: $articleId)..."
$updateBody = @{
    title = "Updated Test Article"
    body = "This is the updated test article content"
} | ConvertTo-Json

$updateResponse = Invoke-RestMethod -Uri "$BASE_URL/articles/$articleId" -Method Put -Body $updateBody -ContentType "application/json"
$updateResponse | ConvertTo-Json

# 5. Delete article
Write-Host "`n5. Deleting article (ID: $articleId)..."
$deleteResponse = Invoke-RestMethod -Uri "$BASE_URL/articles/$articleId" -Method Delete
$deleteResponse | ConvertTo-Json

Write-Host "`nTest completed!" 