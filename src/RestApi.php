<?php
namespace McCaulay\Selly;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class RestApi extends Api
{
    /**
     * The object id.
     *
     * @var string
     */
    protected $id;

    /**
     * When the object was created.
     *
     * @var \Carbon\Carbon
     */
    protected $created_at;

    /**
     * When the object was last updated.
     *
     * @var \Carbon\Carbon
     */
    protected $updated_at;

    /**
     * Initialise a rest api.
     *
     * @param $path The rest api path.
     * @param $instance The object instance.
     */
    public function __construct(string $path, object $instance = null)
    {
        parent::__construct();

        $this->setPath($path);
        if ($instance != null) {
            $this->fillAttributes($instance);
        }
    }

    /**
     * Gets the string representation of this object.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->getId();
    }

    /**
     * Set the properties of this instance from the given object.
     *
     * @param $instance The object instance.
     * @return void
     */
    protected function fillAttributes(object $instance): void
    {
        foreach (get_object_vars($instance) as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Get the objects attributes.
     *
     * @return array
     */
    public function getAttributes(): array
    {
        $attributes = [];
        foreach (get_object_vars($this) as $key => $value) {
            $attributes[$key] = $value;
        }
        return $attributes;
    }

    /**
     * Get all of the rest objects.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function all(): Collection
    {
        return collect($this->get('/'));
    }

    /**
     * Get the rest object for the given id.
     *
     * @param $id The object id.
     * @return object
     */
    protected function find(string $id): object
    {
        return $this->get('/' . $id);
    }

    /**
     * Create the object.
     *
     * @param $attributes The object attributes. If null, then it gets the
     * instances attributes.
     * @return object
     */
    public function save(array $attributes = null): object
    {
        return $this->post('/', [], $attributes != null ? $attributes : $this->getAttributes());
    }

    /**
     * Updates the object.
     *
     * @return object
     */
    public function update(): object
    {
        $attributes = $this->getAttributes();
        return $this->put('/' . $this->getId(), [], $attributes);
    }

    /**
     * Deletes the object.
     *
     * @return void
     */
    public function remove(): void
    {
        $this->delete('/' . $this->getId());
    }

    /**
     * Set the object id.
     *
     * @param  string  $id  The object id.
     * @return  self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the object id.
     *
     * @return  string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set when the object was last updated.
     *
     * @param  \Carbon\Carbon  $updated_at  When the object was last updated.
     * @return  self
     */
    public function setUpdatedAt(Carbon $updated_at): self
    {
        $this->updated_at = $updated_at->toIso8601String();
        return $this;
    }

    /**
     * Get when the object was last updated.
     *
     * @return  \Carbon\Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return new Carbon($this->updated_at);
    }

    /**
     * Set when the object was created.
     *
     * @param  \Carbon\Carbon  $created_at  When the object was created.
     * @return  self
     */
    public function setCreatedAt(Carbon $created_at): self
    {
        $this->created_at = $created_at->toIso8601String();
        return $this;
    }

    /**
     * Get when the object was created.
     *
     * @return  \Carbon\Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return new Carbon($this->created_at);
    }
}
