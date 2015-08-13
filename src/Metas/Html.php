<?php
namespace SocialLinks\Metas;

class Html extends MetaBase implements MetaInterface
{
    /**
     * {@inheritDoc}
     */
    protected function generateTags()
    {
        $data = $this->page->get();

        //<meta>
        if (!empty($data['title'])) {
            $this->addMeta('title', $data['title']);
        }

        if (!empty($data['text'])) {
            $this->addMeta('description', $data['text']);
        }

        //<link>
        if (!empty($data['image'])) {
            $this->addLink('image_src', $data['image']);
        }

        if (!empty($data['url'])) {
            $this->addLink('canonical', $data['url']);
        }
    }
}
