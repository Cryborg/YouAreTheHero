<?php

namespace App\Admin\Controllers\Stories;

use App\Models\Genre;
use App\Models\Story;
use App\Models\StoryGenre;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Layout\Content;
use Hamcrest\Core\AllOf;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Redirector;

/**
 * Class StoryCreateController
 * @package App\Admin\Controllers\Stories
 */
class StoryCreateController extends Controller
{
    public $form;

    /**
     * Set description for following 4 action pages.
     *
     * @var array
     */
    protected $description = [
        'create' => 'Create'
    ];

    /**
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        $form = new Form(new Story());
        $form->setAction(route('admin.story.store'));

        $form->tools(function (Form\Tools $tools) {
            $tools->disableList();
            $tools->disableDelete();
            $tools->disableView();
        });

        $form->footer(function ($footer) {
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        $user = Admin::user();

        $form->text('title', 'Story title')->rules('required|min:3');
        $form->text('description', 'Description')->rules('required|min:3');

        $form->multipleSelect('genres')->options(Genre::all()->pluck('label', 'id'));

        $form->hidden('user_id')->value($user->getAuthIdentifier());
        $this->form = $form;

        $content->row($form);

        return $content;
    }

    /**
     * @param Request $request
     * @return Redirector
     */
    public function store(Request $request)
    {
        $story = new Story();

        $story->title = $request->title;
        $story->description = $request->description;
        $story->user_id = $request->user_id;
        $genres = $request->genres;
        array_pop($genres);

        $storyGenres['story_id'] = array_values($genres);
        $storyGenres = [];
        foreach ($genres as $k => $genre) {
            $storyGenres[$k]['story_id'] = 1;
            $storyGenres[$k]['genre_id'] = $genre;
        }

        $story->save();

        foreach ($storyGenres as $storyGenre) {
            StoryGenre::firstOrCreate($storyGenre);
        }


        return redirect()->route('admin.stories.list');
    }
}
