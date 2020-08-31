<?php


namespace App\Product;


use App\Model\Model;

class ProductImage extends Model
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ProductModel
     */
    protected $product;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var int
     */
    protected $size;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return ProductImage
     */
    public function setId(int $id): ProductImage
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return ProductImage
     */
    public function setProduct(ProductModel $product): ProductImage
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ProductImage
     */
    public function setName(string $name): ProductImage
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return ProductImage
     */
    public function setPath(string $path): ProductImage
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     * @return ProductImage
     */
    public function setSize(int $size): ProductImage
    {
        $this->size = $size;
        return $this;
    }
}