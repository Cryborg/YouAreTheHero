[1mdiff --git a/app/Http/Controllers/CharacterController.php b/app/Http/Controllers/CharacterController.php[m
[1mindex 09d4168..4876791 100644[m
[1m--- a/app/Http/Controllers/CharacterController.php[m
[1m+++ b/app/Http/Controllers/CharacterController.php[m
[36m@@ -42,7 +42,7 @@[m [mclass CharacterController extends Controller[m
                 'name'     => $request->get('name'),[m
                 'user_id'  => Auth::id(),[m
                 'story_id' => $story->id,[m
[31m-                'page_uuid'  => $page->id,[m
[32m+[m[32m                'page_id'  => $page->id,[m
             ][m
             );[m
 [m
[1mdiff --git a/app/Http/Controllers/StoryController.php b/app/Http/Controllers/StoryController.php[m
[1mindex befc6ba..0163103 100644[m
[1m--- a/app/Http/Controllers/StoryController.php[m
[1m+++ b/app/Http/Controllers/StoryController.php[m
[36m@@ -92,7 +92,7 @@[m [mclass StoryController extends Controller[m
         // The character exists, let's go back to the previous save point[m
         // Get the last visited page[m
         if ($page === null || empty($page)) {[m
[31m-            $page = $story->getCurrentPage($character->page_uuid);[m
[32m+[m[32m            $page = $story->getCurrentPage($character->page_id);[m
         }[m
 [m
         if ($page) {[m
[36m@@ -112,7 +112,7 @@[m [mclass StoryController extends Controller[m
         $visitedPlaces = $character->checkpoints;[m
 [m
         $visitedPlaces = $visitedPlaces->map(function ($value, $key) {[m
[31m-            $page                = Page::where('uuid', $value['page_uuid'])[m
[32m+[m[32m            $page                = Page::where('uuid', $value['page_id'])[m
                                        ->firstOrFail();[m
             $value['page_title'] = $page->title;[m
             return $value;[m
[36m@@ -353,10 +353,10 @@[m [mclass StoryController extends Controller[m
         if ($page && $page->is_checkpoint) {[m
             Checkpoint::firstOrCreate([[m
                 'character_id' => $character->id,[m
[31m-                'page_uuid'    => $page->id,[m
[32m+[m[32m                'page_id'    => $page->id,[m
             ], [[m
                     'character_id' => $character->id,[m
[31m-                    'page_uuid'    => $page->id,[m
[32m+[m[32m                    'page_id'    => $page->id,[m
                 ][m
             );[m
         }[m
[36m@@ -587,7 +587,7 @@[m [mclass StoryController extends Controller[m
             }[m
             );[m
 [m
[31m-            $view = View::make('story.partials.treecard', ['pages' => $page->choices()]);[m
[32m+[m[32m            $view = View::make('story.partials.treecard', ['pages' => $page->choices]);[m
 [m
             return $view;[m
         }[m
[1mdiff --git a/app/Models/Page.php b/app/Models/Page.php[m
[1mindex da3fc8e..d149384 100644[m
[1m--- a/app/Models/Page.php[m
[1m+++ b/app/Models/Page.php[m
[36m@@ -76,27 +76,7 @@[m [mclass Page extends Model[m
      */[m
     public function choices()[m
     {[m
[31m-        $pages = Cache::remember('choices_' . $this->id, Config::get('app.story.cache_ttl'), function () {[m
[31m-            $pageLinks = PageLink::where('page_from', $this->id)[m
[31m-                                 ->get();[m
[31m-[m
[31m-            if ($pageLinks) {[m
[31m-                return Page::whereIn('pages.id', $pageLinks->pluck('page_to'))[m
[31m-                           ->select([[m
[31m-                               'page_link.page_to',[m
[31m-                               'page_link.link_text',[m
[31m-                               'pages.*',[m
[31m-                           ][m
[31m-                           )[m
[31m-                           ->join('page_link', 'page_link.page_to', '=', 'pages.id')[m
[31m-                           ->get();[m
[31m-            }[m
[31m-[m
[31m-            return collect();[m
[31m-        }[m
[31m-        );[m
[31m-[m
[31m-        return $pages ?? collect();[m
[32m+[m[32m        return $this->belongsToMany(Page::class, 'page_link', 'page_from', 'page_to', 'id')->withPivot('link_text');[m
     }[m
 [m
     /**[m
[36m@@ -122,13 +102,18 @@[m [mclass Page extends Model[m
         // - the current page[m
         // - the already bound children[m
         $potentialPages = Page::where('story_id', $this->story_id)[m
[31m-                              ->whereNotIn('id', $this->choices()[m
[31m-                                                        ->pluck('id')[m
[31m-                                                        ->toArray()[m
[31m-                              )[m
[31m-                              ->whereNotIn('id', [$this->id])[m
[31m-                              ->orderBy('title', 'asc')[m
[31m-                              ->get();[m
[32m+[m
[32m+[m[32m            // Don't include the choices already bound to the page[m
[32m+[m[32m            ->whereNotIn('id', $this->choices[m
[32m+[m[32m                                    ->pluck('id')[m
[32m+[m[32m                                    ->toArray()[m
[32m+[m[32m            )[m
[32m+[m
[32m+[m[32m            // And of course don't include this page[m
[32m+[m[32m            ->whereNotIn('id', [$this->id])[m
[32m+[m
[32m+[m[32m            ->orderBy('title', 'asc')[m
[32m+[m[32m            ->get();[m
 [m
         return $potentialPages;[m
     }[m
[1mdiff --git a/app/Models/PageLink.php b/app/Models/PageLink.php[m
[1mindex 427ef21..4dfff1f 100644[m
[1m--- a/app/Models/PageLink.php[m
[1m+++ b/app/Models/PageLink.php[m
[36m@@ -13,6 +13,11 @@[m [mclass PageLink extends Model[m
 [m
     public $timestamps = false;[m
 [m
[32m+[m[32m    protected $casts        = [[m
[32m+[m[32m        'page_from'     => Page::class,[m
[32m+[m[32m        'page_to'       => Page::class,[m
[32m+[m[32m    ];[m
[32m+[m
     /**[m
      * Get the page.[m
      */[m
[1mdiff --git a/app/Presenters/PagePresenter.php b/app/Presenters/PagePresenter.php[m
[1mindex 03c3bb6..bb5b015 100644[m
[1m--- a/app/Presenters/PagePresenter.php[m
[1m+++ b/app/Presenters/PagePresenter.php[m
[36m@@ -4,19 +4,20 @@[m [mnamespace App\Presenters;[m
 [m
 use App\Models\Character;[m
 use Illuminate\Support\Facades\Auth;[m
[32m+[m[32muse Illuminate\Support\Facades\Route;[m
 use Laracasts\Presenter\Presenter;[m
 [m
 class PagePresenter extends Presenter[m
 {[m
     public function content()[m
     {[m
[31m-        $storyId = getSession('story_id');[m
[32m+[m[32m        $routeName = Route::currentRouteName();[m
 [m
[31m-        if (!empty($storyId)) {[m
[32m+[m[32m        if ($routeName === 'story.play') {[m
             $character = Character::where([[m
                 'story_id' => getSession('story_id'),[m
                 'user_id' => Auth::id(),[m
[31m-            ])->first();[m
[32m+[m[32m            ])->firstOrFail();[m
 [m
             // List of all placeholders[m
             $placeholders = [[m
[1mdiff --git a/database/seeds/PagesTableSeeder.php b/database/seeds/PagesTableSeeder.php[m
[1mindex b602c46..550bd89 100644[m
[1m--- a/database/seeds/PagesTableSeeder.php[m
[1m+++ b/database/seeds/PagesTableSeeder.php[m
[36m@@ -150,7 +150,7 @@[m [mclass PagesTableSeeder extends Seeder[m
                                                 'is_first' => 0,[m
                                                 'is_last' => 0,[m
                                                 'title' => 'Prendre congé',[m
[31m-                                                'content' => '<p>- Merci beaucoup pour toutes ces informations, Monsieur, vous avez été très aimable.<br>&nbsp; &nbsp; - Mais au plaisir ! Peut-être à une prochaine fois sur une autre Tour !</p><p>Mais oui mais oui, peut-être...</p>',[m
[32m+[m[32m                                                'content' => '<p>- Merci beaucoup pour toutes ces informations, Monsieur, vous avez été très aimable.</p><p>- Mais au plaisir ! Peut-être à une prochaine fois sur une autre Tour !</p><p>Mais oui mais oui, peut-être...</p>',[m
                                                 'layout' => 'play1',[m
                                                 'is_checkpoint' => 0,[m
                                                 'created_at' => '2019-12-21 21:24:42',[m
[1mdiff --git a/database/seeds/StatsTableSeeder.php b/database/seeds/StatsTableSeeder.php[m
[1mindex 2386b70..581848b 100644[m
[1m--- a/database/seeds/StatsTableSeeder.php[m
[1m+++ b/database/seeds/StatsTableSeeder.php[m
[36m@@ -12,55 +12,55 @@[m [mclass StatsTableSeeder extends Seeder[m
      */[m
     public function run()[m
     {[m
[31m-        [m
[32m+[m
 [m
         \DB::table('stats')->delete();[m
[31m-        [m
[32m+[m
         \DB::table('stats')->insert(array ([m
[31m-            0 => [m
[32m+[m[32m            0 =>[m
             array ([m
                 'id' => 1,[m
                 'full_name' => 'Vitesse',[m
                 'short_name' => 'VTS',[m
             ),[m
[31m-            1 => [m
[32m+[m[32m            1 =>[m
             array ([m
                 'id' => 2,[m
                 'full_name' => 'Force',[m
[31m-                'short_name' => 'FRC',[m
[32m+[m[32m                'short_name' => 'FOR',[m
             ),[m
[31m-            2 => [m
[32m+[m[32m            2 =>[m
             array ([m
                 'id' => 3,[m
                 'full_name' => 'Agilité',[m
[31m-                'short_name' => 'AGL',[m
[32m+[m[32m                'short_name' => 'AGI',[m
             ),[m
[31m-            3 => [m
[32m+[m[32m            3 =>[m
             array ([m
                 'id' => 4,[m
                 'full_name' => 'Intelligence',[m
                 'short_name' => 'INT',[m
             ),[m
[31m-            4 => [m
[32m+[m[32m            4 =>[m
             array ([m
                 'id' => 5,[m
                 'full_name' => 'Discrétion',[m
                 'short_name' => 'DIS',[m
             ),[m
[31m-            5 => [m
[32m+[m[32m            5 =>[m
             array ([m
                 'id' => 6,[m
                 'full_name' => 'Perception',[m
[31m-                'short_name' => 'PCP',[m
[32m+[m[32m                'short_name' => 'PER',[m
             ),[m
[31m-            6 => [m
[32m+[m[32m            6 =>[m
             array ([m
                 'id' => 7,[m
                 'full_name' => 'Charisme',[m
[31m-                'short_name' => 'CHR',[m
[32m+[m[32m                'short_name' => 'CHA',[m
             ),[m
         ));[m
[31m-        [m
[31m-        [m
[32m+[m
[32m+[m
     }[m
[31m-}[m
\ No newline at end of file[m
[32m+[m[32m}[m
[1mdiff --git a/resources/views/page/create.blade.php b/resources/views/page/create.blade.php[m
[1mindex daa7e60..2defd4b 100644[m
[1m--- a/resources/views/page/create.blade.php[m
[1m+++ b/resources/views/page/create.blade.php[m
[36m@@ -52,11 +52,11 @@[m
             @info({!! trans('page.current_page_choices_help') !!})[m
 [m
             <nav class="nav nav-tabs">[m
[31m-                @if($page->choices())[m
[31m-                    @foreach($page->choices() as $key => $choice)[m
[32m+[m[32m                @if($page->choices)[m
[32m+[m[32m                    @foreach($page->choices as $key => $choice)[m
                         <a class="nav-item nav-link @if ($key === 0) active @endif" href="#p{{ $key }}" data-toggle="tab">[m
                             <span class="choice_title_{{ $key }}">[m
[31m-                                <input type="text" class="form-control" placeholder="{{ trans('page.link_text') }}" id="linktext-{{ $key + 1 }}" value="{{ $choice->link_text }}">[m
[32m+[m[32m                                <input type="text" class="form-control" placeholder="{{ trans('page.link_text') }}" id="linktext-{{ $key + 1 }}" value="{{ $choice->pivot->link_text }}">[m
                             </span>[m
                         </a>[m
                     @endforeach[m
[36m@@ -74,8 +74,8 @@[m
                 </a>[m
             </nav>[m
             <div class="tab-content" id="choicesForm">[m
[31m-                @if($page->choices())[m
[31m-                    @foreach($page->choices() as $key => $choice)[m
[32m+[m[32m                @if($page->choices)[m
[32m+[m[32m                    @foreach($page->choices as $key => $choice)[m
                         <div class="tab-pane @if ($key === 0) active @endif" id="p{{ $key }}">[m
 {{--                            @include('page.partials.create_readonly', ['page' => $choice, 'child' => true])--}}[m
                             @include('page.partials.create', ['page' => $choice])[m
[1mdiff --git a/resources/views/page/partials/create.blade.php b/resources/views/page/partials/create.blade.php[m
[1mindex 53ffcdb..2587977 100644[m
[1m--- a/resources/views/page/partials/create.blade.php[m
[1m+++ b/resources/views/page/partials/create.blade.php[m
[36m@@ -31,9 +31,7 @@[m
                         </div>[m
 [m
                         <p class="help-block">{{ trans('model.page_content_help') }}</p>[m
[31m-                        <div id="content-{{ $page->id }}" class="false-input scrollable-content">[m
[31m-                            {!! $page->content ?? old('content') !!}[m
[31m-                        </div>[m
[32m+[m[32m                        <div id="content-{{ $page->id }}" class="false-input scrollable-content">{!! $page->content ?? old('content') !!}</div>[m
                     </div>[m
 [m
                     <div class="form-group hidden">[m
[36m@@ -49,7 +47,7 @@[m
                             @lang('model.is_first')[m
                         </label>[m
                     </div>[m
[31m-                    @if (!$page->is_first && $page->choices() && $page->choices()->count() === 0)[m
[32m+[m[32m                    @if (!$page->is_first && $page->choices && $page->choices()->count() === 0)[m
                         <div class="form-group form-check">[m
                             <p class="help-block">{{ trans('model.page_is_last_help') }}</p>[m
                             <label>[m
[1mdiff --git a/resources/views/page/partials/modal_list_pages.blade.php b/resources/views/page/partials/modal_list_pages.blade.php[m
[1mindex 8d6ba32..e2bd18f 100644[m
[1m--- a/resources/views/page/partials/modal_list_pages.blade.php[m
[1m+++ b/resources/views/page/partials/modal_list_pages.blade.php[m
[36m@@ -28,7 +28,9 @@[m
                                         <span class="glyphicon glyphicon-fast-forward"></span>[m
                                     </div>[m
                                 @endif[m
[31m-                            {{ $page->title }}[m
[32m+[m[32m                            <a href="{{ route('page.edit', ['page' => $page->id]) }}">[m
[32m+[m[32m                                {{ $page->title }}[m
[32m+[m[32m                            </a>[m
                         </td>[m
                         <td>{!! $page->present()->content !!}</td>[m
                         <td>{{ $page->updated_at }}</td>[m
