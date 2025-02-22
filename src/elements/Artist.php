<?php


namespace datagutten\Tidal\elements;


use datagutten\Tidal\TidalError;

class Artist extends Element
{
    protected array $fields = ['id', 'name', 'type', 'url'];
    protected static array $optional_fields = ['type', 'url'];
    /**
     * @var int Artist ID
     */
    public $id;
    /**
     * @var string Artist name
     */
    public $name;
    /**
     * @var string Artist relation type
     */
    public $type;
    /**
     * @var string URL to artist page
     */
    public string $url;

    /**
     * @return Album[]
     * @throws TidalError
     */
    public function albums(): array
    {
        $album_objs = [];
        $albums = $this->tidal->artist_albums($this->url);
        foreach ($albums['items'] as $key=>$album)
        {
            $album_objs[$key] = new Album($album, null, $this->tidal);
            $album_objs[$key]->get_tracks();
        }
        return $album_objs;
    }
}